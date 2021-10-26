# Twenty20-vignoble

> _Child of **Twenty Twenty** master theme. Both themes are REQUIRED on the production server for this theme to work properly_


&nbsp;

## How to build a site with this theme

| page/post | template | plugin dependancy | logic
| :--- | :--- | :--- | :---
| Home | `front-page.php` | Advanced Custom Fields PRO | Custom page relying on ACF Pro repeters to display teasers under a hero image.
| Contact | `singular-contact.php` | Rely on plugin [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) for the **Message form**.
| Detailed product | `singular-product.php` | Advanced Custom Fields | Common custom template relying on ACF to display « _product specifications_ » (`acf-product-specs`) and « _SAQ tags_ » (`saqtag`).
| Products index | - | List-page | Displays a list on it's child pages.



&nbsp;

## Maintenance and Development


### Theme

1. Latest version [**Twenty20-vignoble** on Github](https://github.com/martindubenet/twenty20-vignoble)
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
      - ACF fields are declared via PHP within the `functions.php` file. Any _key_ parameters or values that are define in the functions file over-rule what is changed in the ACF admin page.
      - The PRO licence is required for the REPEATER used on the front-page.
-   [Page-list](https://wordpress.org/plugins/page-list/) for the product index page.
   - `[pagelist_ext sort_column="menu_order"]`
-   [WP Super Cache](https://wordpress.org/plugins/wp-super-cache/) for speeding up wordpress download time for optimised UX.

#### Optionals plugins

-   [Catch IDs](https://wordpress.org/plugins/catch-ids/)
-   [PHP Compatibility Checker](https://wordpress.org/plugins/php-compatibility-checker/)
-   [What The File](https://wordpress.org/plugins/what-the-file/)


&nbsp;

&nbsp;

&nbsp;