# Nestora Store — Task 3 submission report

Prepared on 27 October 2026 (Asia/Karachi).

## Delivered store

Nestora is a working local WordPress/WooCommerce store using the user-supplied **Ecomus 2.4.0** parent and a custom **Nestora Store** child theme. The database is **native MySQL 8.4**, not SQLite. The brand and category direction follow the supplied Nestora guide. The later user instruction selected browsed stock photography in place of the initial illustrations.

| Assignment requirement | Implementation and evidence |
|---|---|
| Customized logo and branding | Original Nestora house/nest mark, serif wordmark, site icon; plum, champagne and warm-ivory palette with layered gradients, soft shadows and reduced-motion-aware entrance effects; locally bundled licensed fonts |
| At least 5 categories | Home Decor; Kitchen & Dining; Bedding & Bath; Lighting; Storage & Organization |
| At least 10 products per category | Exactly 50 published WooCommerce products, 10 in each category |
| Complete product information | Product name, long/short descriptions, licensed photograph, regular/sale prices, category, SKU, stock quantity and shipping weight |
| Cart and checkout | Native WooCommerce cart and classic checkout; browser Add to cart and Cart → Checkout flow inspected; server-side checkout tested through WooCommerce Store API |
| Payment method configured/tested | Official WooCommerce Dummy Payments gateway: supported Success and Failure settings tested; Cash on Delivery also tested |
| Shipping and order management | Pakistan PKR 350 standard/PKR 750 express, free standard over PKR 15,000 after discounts; international PKR 3,500; completed/failed/COD orders, stock changes, notes and a manual test refund |
| Essential pages | Home, Shop, About, Contact, Cart, Checkout, My Account, Shipping & Returns, Privacy, Terms, FAQ |
| Shopping process tested | 45 automated route/catalogue/cart/coupon/shipping/payment/order checks passed; additional account/contact/newsletter/address checks passed |
| Responsive and easy to navigate | Desktop and 390 px mobile views inspected; mobile menu expansion and Escape-to-close verified; checkout labels/controls fit the inspected viewport |

An additional **55 public storefront checks** verified the browsable shop, category/price/availability filters, price sorting, a genuine 404 response and all 50 locally bundled stock-image URLs. Exact results are in `reports/verification.json`, `reports/extra-checks.json`, and `reports/frontend-checks.json`.

## Payment testing — exact scope

The user confirmed they have no payment processor account or API keys. Therefore no Stripe or PayPal account was created, no credentials were invented, and no external sandbox/live transaction is claimed.

The installed test gateway is WooCommerce's own [Dummy Payments Gateway](https://github.com/woocommerce/woocommerce-gateway-dummy). Its documented Payment result setting controls supported success/failure simulation. See [WooCommerce's developer explanation](https://developer.woocommerce.com/2022/07/07/exposing-payment-options-in-the-checkout-block/). The tested Success path created a paid order and reduced stock; Failure rejected checkout and left a failed order. Cash on Delivery created a processing order. The manual refund is an internal WooCommerce record and moves no real funds.

**If the assessor requires an external card gateway specifically, this remains an account/credential-dependent requirement.** A Stripe/PayPal sandbox or verified live integration has not been performed. The current store demonstrates supported gateway simulation plus an offline payment method, clearly labelled at checkout.

## Email and customer records

Order and account emails are captured in **Store email log**. No inbox-delivery claim is made. Test customer accounts, address changes, contact enquiries and newsletter consent are persisted in MySQL. Only fictional local details were used. The administrator can inspect the retained records in the dashboard.

## Images and editing

All active product images are browsed Pexels photographs bundled locally under the free-use Pexels License. They are illustrative stock, not verified Nestora inventory photography. Full source links are listed in `PHOTO-CREDITS.md` and `exports/photo-credits.json`. The logo is original artwork; Playfair Display and Inter include their open-font licenses. The parent theme/addons were supplied by the user and stay in the private handover.

Pages use native editable WordPress blocks. Products, prices, stock and images use native WooCommerce records. The handover includes the child theme/plugin source, SQL backup, media, product CSV, block-page exports, logo formats, screenshots, photo credits and XAMPP restoration instructions.

## Restoration and practical limits

The final MySQL dump is tested in a separate empty MySQL database before delivery; the restoration report is included. The XAMPP restoration guide uses serialized-data-safe URL replacement with the bundled official WP-CLI. An actual XAMPP/MariaDB installation has not been run on this machine.

Local PHP runs through a development WebAssembly runtime connected to native MySQL. Its response timings are not production performance scores. Native hosting should use a suitable PHP/MySQL environment and perform destination checks. The store is a coursework demonstration: real company/contact information, real stock/fulfilment, verified processor credentials, SMTP and final legal policies are required before trading publicly.

## Design and currency revision

Updated to plum, champagne and ivory with layered gradients, softer cards, percentage sale badges, hover depth and one-time scroll entrance motion. Reduced-motion preferences are respected. All 50 current product prices, shipping and new checkout orders use PKR. Historical test orders retain their original order currency. PKR catalogue pricing uses a fixed coursework factor of 280, rounded to PKR 50; no live exchange-rate service is connected.
