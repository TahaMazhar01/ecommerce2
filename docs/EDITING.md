# Editing Nestora

## Pages

Open **Pages → All Pages → Edit**. Home is made of native Group, Columns, Heading, Paragraph, Image and Button blocks. You can edit each heading, photo, link and paragraph visually. Keep the existing `ns-*` CSS classes under **Advanced** to retain the design. The homepage's category and featured-product sections are dynamic shortcode blocks: edit their WooCommerce records rather than rewriting the generated HTML.

The in-app browser's blob-based visual canvas did not render during inspection; native Code editor mode and the stored block source were accessible. If the canvas is blank in that browser, use normal Chrome/Edge or the destination XAMPP browser for visual editing. Code editor is under the three-dot Options menu; exported `.html` files retain the native block comments.

Shop, Cart, Checkout and My Account use WooCommerce's assigned pages. Keep `[woocommerce_cart]`, `[woocommerce_checkout]` and `[woocommerce_my_account]` intact unless deliberately migrating to WooCommerce blocks. Checkout is functional server-side.

## Products and photos

Open **Products → All Products** to change names, long/short descriptions, prices, categories, featured stars, SKU, shipping weight, stock, or Product image. Stock levels in the final backup include the documented test orders; this is intentional. The CSV under `exports/` is suitable for WooCommerce's product importer, with image URLs pointing to the original local site. Replace the URL before importing on another host, or restore the complete SQL/media package first.

There are 50 photographed demo products, 10 in each of Home Decor, Kitchen & Dining, Bedding & Bath, Lighting, and Storage & Organization. The photos are licensed stock, not photographs of actual Nestora inventory. Their source URLs and license are documented in `PHOTO-CREDITS.md` and `exports/photo-credits.json`. Replace them with verified inventory photography before selling real goods.

## Branding, header and footer

The active child is **Nestora Store**, parent **Ecomus 2.4.0**. Change menu entries under **Appearance → Menus** for Nestora / Main menu and Nestora / Footer menu. The visible wordmark uses the editable WordPress site title. Header and footer markup are in the child theme's `header.php` and `footer.php`; their source is fully editable. The custom logo and icon files are included in `brand/`.

Coordinated colours, fonts, responsive rules, shadows and hover effects are in `theme/assets/nestora.css`. Main palette: ink/plum `#332B39`, champagne `#E6CFAF`, warm ivory `#FAF7F3`. Motion/menu logic is in `theme/assets/nestora.js`, with reduced-motion support. This design uses no animation-library dependency.

## Forms, email and orders

Contact and newsletter forms store private records visible only to administrators. The custom plugin `nestora-store` controls validation, consent, local email logging and dashboard integration. It records emails rather than sending externally. Disable the `nestora_log_email` option only after setting up SMTP and verifying actual receipt.

Manage orders in **WooCommerce → Orders**. The official dummy gateway creates paid/failed test orders according to its setting. COD records offline orders. An administrator can change status, add notes and record a manual refund; a dummy-gateway refund moves no real money. All payment limitations appear in `START-HERE.md` and the submission report.
