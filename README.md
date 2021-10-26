# Twenty20-acf

> _Child of **Twenty Twenty** master theme. Both themes are REQUIRED on the server for this theme to work properly_


&nbsp;

## How to build a site with this theme

| page/post | template | plugin dependancy | logic
| :--- | :--- | :--- | :---
| Detailed product | `inc/content-product.php` | Advanced Custom Fields | Common custom template relying on ACF to display « _price and availability_ » (`product-price`), « _specifications_ » (`product-specs`) and « _Taste tags_ » (`tastetag`).
| Home | `front-page.php` | Advanced Custom Fields **PRO** | (Work in progress) Custom page relying on ACF Pro **repeters** to display product teasers as a gallery under a hero image.



&nbsp;

## Maintenance and Development


### Theme

1. Latest version [**Twenty20-acf** on Github](https://github.com/martindubenet/twenty20-acf)
1. [Twenty Twenty (v.1.8)](https://wordpress.org/themes/twentytwenty/)
1. [NodeJs](https://nodejs.org/en/download/)
   1. npm package [Dart Sass](https://www.npmjs.com/package/sass" target="nodejs) for compiling stylesheets from `/src/sass/` to `/assets/css/`.

#### npm scripts

| bash command line | description
| :--- | :---
| `npm run watch` | Re-compile the Sass files on every _Save_ action in a `.scss` file detected by the OS.
| `npm run compile` | Compile all Sass files only once. IMPORTANT to run this one before uploading via FTP on production server.

### Required plugins for this theme

-   [Advanced Custom Fields **PRO** (_ACF_)](https://wordpress.org/plugins/advanced-custom-fields/) (version 5.10.2) for product detailed pages (`/singular-product.php`). 
      - ACF fields are declared via PHP within the `functions.php` file. Any _key_ parameters or values that are define in the functions file is prioritise over what is set in ACF database via dashboard.
      - The PRO licence is required for the REPEATER used on the front-page.



&nbsp;

&nbsp;

&nbsp;