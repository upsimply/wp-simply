/*
 * The theme's Alpine.js components. Loaded before Alpine, which starts once
 * the page is parsed and picks these up as it does.
 *
 * Small behaviour belongs in the templates themselves (x-data="{ open: false }").
 * A component goes here once it is used in more than one place or needs more
 * than a line.
 */

document.addEventListener('alpine:init', () => {
    /*
     * The number of items in the visitor's cart, beside the header's cart link.
     *
     * The page arrives with the count it was rendered with, which may be
     * somebody else's when the page came from the page cache, so a visitor
     * with something in their cart has it read again from WooCommerce's Store
     * API. It is read again whenever WooCommerce says the cart changed: the
     * classic add-to-cart buttons say so through jQuery, the Cart and
     * Checkout blocks through events of their own.
     */
    window.Alpine.data('cartCount', (initial = 0) => ({
        count: initial,

        get label() {
            const i18n = window.upsimply?.i18n ?? {};

            return this.count > 0
                ? (i18n.cartWithCount ?? 'Cart (%d)').replace('%d', String(this.count))
                : (i18n.cart ?? 'Cart');
        },

        init() {
            if (document.cookie.includes('woocommerce_items_in_cart=1')) {
                this.refresh();
            } else {
                this.count = 0;
            }

            ['wc-blocks_added_to_cart', 'wc-blocks_removed_from_cart'].forEach((name) => {
                document.body.addEventListener(name, () => this.refresh());
            });

            if (window.jQuery) {
                window.jQuery(document.body).on('added_to_cart removed_from_cart updated_cart_totals', () => this.refresh());
            }
        },

        async refresh() {
            const api = window.upsimply?.storeApi;

            if (!api) return;

            try {
                const response = await fetch(`${api}cart`, {
                    credentials: 'same-origin',
                    headers: { Accept: 'application/json' },
                });

                if (response.ok) {
                    this.count = (await response.json()).items_count ?? 0;
                }
            } catch {
                // The count is a courtesy: the cart page is always right.
            }
        },
    }));
});
