# Nestora — complete WooCommerce handover

**Current theme: Ecomus 2.4.0 with the Nestora child theme. Database: real MySQL.**

The site includes 50 native WooCommerce products across five categories (10 per category), licensed stock product photos, a custom logo, regular/sale prices, stock, shipping, WELCOME10, shopping cart, checkout, customer accounts and editable WordPress block pages. The supplied Ecomus package replaced the initial Foodu selection after it became available.

## Open on this computer

- Store: `http://127.0.0.1:9500/`
- Dashboard: `http://127.0.0.1:9500/wp-admin/`
- Private login: `LOCAL-ACCESS.txt` in the handover ZIP, or `runtime/LOCAL-ACCESS.txt` in the project.
- Orders: **WooCommerce → Orders**. Products: **Products → All Products**.
- Contact messages, newsletter records and captured emails: **Store messages**, **Nestora Club**, **Store email log**.

This development site uses PHP 8.3 through WordPress Playground, connected to native MySQL 8.4 on `127.0.0.1:9336`. SQLite is not used. It is separate from ForgeLine's database and site directory.

## Restore in XAMPP

1. Start Apache and MySQL in XAMPP. Use PHP 8.2/8.3 or another version supported by the bundled WordPress/WooCommerce versions. If an older XAMPP PHP rejects the site, upgrade PHP before proceeding.
2. Copy the contents of the package's `wordpress/` directory into `C:\xampp\htdocs\nestora\`.
3. In phpMyAdmin, create an **empty** database named `nestora_db` with `utf8mb4_unicode_ci`, then import `database/nestora.sql`. Importing into an empty database avoids overwriting another site.
4. In the copied WordPress folder, copy `wp-config-sample.php` to `wp-config.php`. Set `DB_NAME` to your database name, `DB_USER`/`DB_PASSWORD` to your local MySQL account, and `DB_HOST` to `localhost` (or your configured port). Keep table prefix `wp_` and character set `utf8mb4`. Generate fresh WordPress security salts. The previous computer's database credentials are deliberately excluded.
5. Open PowerShell in the extracted package directory and safely replace the old URL using the included official WP-CLI:

```powershell
& 'C:\xampp\php\php.exe' '.\tools\wp-cli.phar' --path='C:\xampp\htdocs\nestora' search-replace 'http://127.0.0.1:9500' 'http://localhost/nestora' --all-tables-with-prefix --precise --skip-columns=guid
```

Use your actual destination URL if Apache uses another port. This command handles serialized WordPress data; a plain text SQL replacement can corrupt it. If your PHP cannot run WP-CLI, use a WordPress migration tool with serialized-data support and configure the same URL replacement.

6. Visit `http://localhost/nestora/wp-admin/` and sign in using the private WordPress login. Save **Settings → Permalinks** once. Open Home, Shop, a product, Cart, Checkout and My Account. Confirm product images load.
7. Test a new dummy or COD order, then check **WooCommerce → Orders** and the product's stock.

The current SQL dump has been tested by importing it into a separate empty **MySQL** database. XAMPP/MariaDB installation has not been executed on this computer; if a destination MariaDB version reports SQL incompatibility, retain the original dump and use a matching MySQL 8.4 server or an appropriate export conversion.

## Payment demonstration — read before submission

The user confirmed that no Stripe/PayPal account or keys are available. Two gateways are enabled:

- **Cash on Delivery**: real WooCommerce offline order workflow. No online charge occurs.
- **Test payment — no real charge**: the **official WooCommerce Dummy Payments Gateway**, developed for WooCommerce testing. Its supported Success and Failure modes have been tested. It simulates payment completion; it does not contact Stripe, PayPal, a bank or a card network.

To demonstrate failure, go to **WooCommerce → Settings → Payments → Dummy Payment**, set **Payment result** to **Failure**, and place a test order. Restore **Success** afterward. Do not enter a real card number. The test records remain in the dashboard for inspection.

This proves a working store and supported gateway simulation. It is **not** evidence of a Stripe/PayPal sandbox transaction or a verified live processor. If the assessor requires an external card processor specifically, account/test credentials are still required. The submission report states this limitation explicitly.

Official references: [WooCommerce dummy gateway](https://github.com/woocommerce/woocommerce-gateway-dummy), [WooCommerce's gateway testing explanation](https://developer.woocommerce.com/2022/07/07/exposing-payment-options-in-the-checkout-block/), [Cash on Delivery](https://woocommerce.com/document/cash-on-delivery/).

## Shipping and offers

- Currency: PKR, updated at the user�s request. Product prices were repriced using a fixed coursework factor of 280 and rounded to PKR 50; this is not a live exchange-rate feed.
- Pakistan standard PKR 350; express PKR 750; free standard shipping from PKR 15,000 **after discounts**.
- Other countries: PKR 3,500 flat rate.
- `WELCOME10`: 10% discount, one use per customer; no expiry for the local assignment.
- Products manage stock and WooCommerce reduces it through successful checkout.

## Editing and source

See `EDITING.md`. Every page uses native WordPress blocks. Products are native WooCommerce data. The child theme, custom plugin, product CSV, block-page exports, logo SVG/PNG, fonts/licenses and photo credits are included. Use the actual WordPress dashboard for edits; source seed files describe the initial build and should not be run over an edited site.

Keep this package private: it contains the site's account hashes, test orders, local login and licensed parent theme. Do not upload its SQL files, login file or tools directory into the public web root. Store email delivery is logged locally; SMTP and a real recipient must be configured and tested before a public launch.
