# Nestora — independent WordPress store

Ecomus child theme, WooCommerce store tools and editable handover for Nestora. This is a separate project and Git repository from ForgeLine Steel.

- `theme/`: editable Nestora Ecomus child theme.
- `plugin/`: contact, newsletter and local email logging tools.
- `assets/`: branding and licensed product photographs with source credits.
- `docs/START-HERE.md`: XAMPP restoration and local access instructions.
- `docs/EDITING.md`: page, catalogue and template editing.
- `dist/`: private full WordPress/MySQL handover ZIP, exports and verification reports. Database dumps and ZIPs are excluded from Git.

Local preview: `http://127.0.0.1:9500/`. With the existing private local WordPress configuration and MySQL service running, use `npm install` then `npm start`. A fresh checkout should restore the private handover using the XAMPP guide; WordPress core, licensed vendor themes/plugins, credentials and database state are deliberately not published in Git.

Nestora has its own `nestora_db` database and WordPress files. The installed MySQL server is a shared local service; neither site's database is copied into the other's repository. External card payment requires a gateway account; the official dummy gateway and COD are configured for coursework testing.
