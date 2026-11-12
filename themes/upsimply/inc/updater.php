<?php

/**
 * Tells WordPress when a newer release of the theme is out.
 *
 * The theme is not one WordPress.org knows, so nothing would ever say a new
 * version exists. This answers WordPress's own update check with an entry in
 * the same shape WordPress.org's API gives one, read from a small JSON
 * manifest: the version, a link to what changed, and the WordPress and PHP
 * versions it needs. wp-admin, WP-CLI and the hosting panel then show the
 * update the way they show any other.
 *
 * It announces, it never installs. This copy of the theme belongs to the site
 * -- it is kept in the site's own history and edited there -- so replacing it
 * wholesale would throw those edits away. The entry carries no package, which
 * is how WordPress is told an update exists that it cannot apply itself; the
 * hosting panel applies it instead, as a reviewed change that keeps the
 * site's edits.
 *
 * The manifest is published with every release of the theme. A site the
 * upsimply panel manages is pointed at the panel's copy instead, through the
 * `upsimply_theme_update_url` filter, which only lists releases the panel has
 * approved.
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * The manifest of the newest release, published beside every release.
 */
const UPSIMPLY_THEME_UPDATE_URL = 'https://github.com/upsimply/wp-simply/releases/latest/download/update.json';

/**
 * How long a manifest is kept before it is asked for again, and how long a
 * manifest that could not be read is, so a host that is down is not asked on
 * every page load of wp-admin.
 */
const UPSIMPLY_THEME_UPDATE_TTL = 6 * HOUR_IN_SECONDS;

const UPSIMPLY_THEME_UPDATE_RETRY = HOUR_IN_SECONDS;

/**
 * Get the newest release the manifest describes, or null when there is none
 * to be had.
 *
 * @return array{new_version: string, url: string, requires: string, requires_php: string}|null
 */
function upsimply_theme_release(): ?array
{
    $cached = get_site_transient('upsimply_theme_update');

    if (is_array($cached)) {
        return $cached['release'] ?? null;
    }

    $url = (string) apply_filters('upsimply_theme_update_url', UPSIMPLY_THEME_UPDATE_URL);
    $release = null;

    if (str_starts_with($url, 'https://')) {
        $response = wp_remote_get($url, ['timeout' => 10, 'headers' => ['Accept' => 'application/json']]);

        if (! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $release = upsimply_theme_read_manifest((string) wp_remote_retrieve_body($response));
        }
    }

    set_site_transient('upsimply_theme_update', ['release' => $release], $release === null ? UPSIMPLY_THEME_UPDATE_RETRY : UPSIMPLY_THEME_UPDATE_TTL);

    return $release;
}

/**
 * Read a manifest, keeping only what it has any business saying.
 *
 * @return array{new_version: string, url: string, requires: string, requires_php: string}|null
 */
function upsimply_theme_read_manifest(string $json): ?array
{
    $manifest = json_decode($json, true);

    if (! is_array($manifest) || ! is_string($manifest['new_version'] ?? null) || preg_match('/^\d+\.\d+\.\d+$/', $manifest['new_version']) !== 1) {
        return null;
    }

    $url = is_string($manifest['url'] ?? null) && str_starts_with($manifest['url'], 'https://') ? $manifest['url'] : '';

    return [
        'new_version' => $manifest['new_version'],
        'url' => esc_url_raw($url),
        'requires' => is_string($manifest['requires'] ?? null) ? $manifest['requires'] : '',
        'requires_php' => is_string($manifest['requires_php'] ?? null) ? $manifest['requires_php'] : '',
    ];
}

/**
 * Answer WordPress's update check for this theme.
 *
 * Runs whenever WordPress refreshes what it knows about theme updates, every
 * twelve hours; the manifest is read again once its own cache runs out. The
 * entry has no package: see the top of this file.
 */
add_filter('pre_set_site_transient_update_themes', static function (mixed $transient): mixed {
    if (! is_object($transient) || ! isset($transient->checked) || ! is_array($transient->checked)) {
        return $transient;
    }

    // The directory the theme was installed under is the slug WordPress
    // checks it by.
    $slug = basename(dirname(__DIR__));
    $installed = $transient->checked[$slug] ?? null;

    if (! is_string($installed)) {
        return $transient;
    }

    // From the cache: WordPress sets the transient twice in one check.
    $release = upsimply_theme_release();

    if ($release === null) {
        return $transient;
    }

    $entry = [
        'theme' => $slug,
        'new_version' => $release['new_version'],
        'url' => $release['url'],
        'package' => '',
        'requires' => $release['requires'],
        'requires_php' => $release['requires_php'],
    ];

    if (version_compare($release['new_version'], $installed, '>')) {
        $transient->response[$slug] = $entry;
        unset($transient->no_update[$slug]);
    } else {
        $transient->no_update[$slug] = $entry;
        unset($transient->response[$slug]);
    }

    return $transient;
});
