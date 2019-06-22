=== Passster - Age Gate ===
Contributors: patrickposner
Tags: age verification, age gate, age restriction, age popup, page gate, content warning
Requires at least: 3.5
Tested up to: 5.2
Stable tag: 4.0.8

== Description ==

Passster Age Gate is your complete solution to age restriction for your website or woocommerce shop.
Let users verify their age before they actually access your page. 

This comes specially handy if your content or products are about alcohol, gambling or other adult content.

Passster Age Gate make it easier then ever to setup, configure and style an age restriction pop up to protect unallowed access to your page.

== How to use ==

After successfull installation and activation go to the WordPress Customizer. You can find it in your black admin bar.
There is a new section called "Passster Age Gate". There you can customise all colors, texts, background images, logo and so on.

Next step is in your admin area under Settings->Passster Age Gate. Set up the default age, exclude or include specific pages or prevent the display of the age gate from registered users.

== Features ==

* Let users verify their age on page visit
* SEO friendly - This plugin automatically let bots and crawlers bypass the age gate (including google page speed bots)
* Whitelist / Blacklist: Restrict your content per page, per post or per category
* Use one or two column mode for additonal explanations
* Add your own logo and set a unique teaser area (two column mode)
* Show the age gate only for non-registered users
* Modify every text, color, background image and more with the WordPress Customizer
* pre-configured styling with background image and logo give you a simple start point
* redirect failed logins to a specified page
* mobil-friendly design

**Pro**

Passster Age Gate Pro comes with some handy advantages over the free version:

***WooCommerce Addon***

If you have a WooCommerce store you will really like this addon. Add age verifcation to the registration and the checkout or
exclude products directly from your store if the customer does not have the minimum age.

* Whitelist / Blacklist for products and product categories
* Add a age verification checkbox to your registration
* Add a age verification checkbox to your checkout
* exclude products from your store if the customer does not match your defined age
* save users age acception in your account and use it later

***More Verification Types***

We also included some additional verification types in the pro version.
Maybe you want to show your visitors a date picker or a slider instead of a yes or no option.

* Use a modern date-picker to let users verify their age.
* Use a slider to let users pick their age


== Support ==

The free support is exclusively limited to the wordpress.org support forum.

Any kind of email priority support, customization and integration help need a valid premium license.


=== CODING STANDARDS MADE IN GERMANY ===

The plugin is coded with modern PHP and WordPress standards in mind. It’s fully OOP coded. It’s highly extendable for developers through several action and filter hooks.

Passster keeps your website performance in mind. Every script is loaded conditionally and all input and output data is secured.


=== MULTI-LANGUAGE ===

All major texts and information can be modified from the WordPress Customizer .

The plugin is fully translatable in your language. At the moment there are only en_EN and de_DE, but you can easily add your preferred language as a .po/.mo.

It’s also fully compatible with WPML and Polylang.


== Installation ==

= Default Method =
1. Go to Settings > Plugins in your administrator panel.
1. Click `Add New`
1. Search for Content Warning v2
1. Click install.

= Easy Method =
1. Download the zip file.
1. Login to your `Dashboard`
1. Open your plugins bar and click `Add New`
1. Click the `upload tab`
1. Choose `content-warning-v2` from your downloads folder
1. Click `Install Now`
1. All done, now just activate the plugin
1. Go to CWv3 menu and configure
1. Save, and you're all good.

= Old Method =
1. Upload `content-warning-v2` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress


== Screenshots ==

1. Two-Column mode
2. One-Column mode
3. Customizer Settings
3. Admin settings

== Changelog ==

= 4.0.8 =
* prevents collision if free and pro version installed
* check if migrate_page_authorization exists before using it

= 4.0.7 =
* security fix freemius sdk
* background image option

= 4.0.6 =
* fix center mode for IE 9 - 11

= 4.0.5 =
* z-index options in customizer
* prevent whitelist option update on plugin update

= 4.0.4 =
* compatibility bridge theme
* fix modifiy height settings
* translation fixes for german admin

= 4.0.3 =
* fixed some migration problems
* set z-index for the box
* fixed [age] shortcode in output
* fixed age gate check on page load
* optimized responsive design

= 4.0.2 =
* improved migration from content-warning-v2

= 4.0.1 =
* improved initial configuration
* improved migration for headline, message, exit and enter buttons
* fixed namespace for PSAG_Helper
* add notice with customizer link
* improved readme
* modified some default values for the customizer

= 4.0 =
* under new development
* complete redevelopment of the current age verification plugin
* adding migration options for Upgrade

= 3.7.2 =
* Removed some rogue logging methods.

= 3.7.1 =
* Fixed category saving in options Fixes [#59](https://github.com/JayWood/content-warning-v3/issues/59)

= 3.7 =
* Fixed an opacity bug where if user set opacity to 0, it was ignored. This should no longer happen.
* Move to the settings API, drop JW Simple Options framework ( I was a newbie when I made it ). Fixes [#45](https://github.com/JayWood/content-warning-v3/issues/45)
* Use Select2 for categories
* Use a better check method for checkboxes and multi-select - fixes [#49](https://github.com/JayWood/content-warning-v3/issues/49)
* Set opacity step to 0.1 - Fixes [#55](https://github.com/JayWood/content-warning-v3/issues/55)

= 3.6.9 =
* Small cleanup
* Force text color to be black - fixes [#43](https://github.com/JayWood/content-warning-v3/issues/43)
* Use `COOKIEPATH` instead of `SITECOOKIEPATH` constants, compatibility fix for sub-folder installs - fixes [#42](https://github.com/JayWood/content-warning-v3/issues/42)

= 3.6.8 =
* Use background-image css property instead of just background - thanks to [95CivicSi](https://github.com/95CivicSi)

= 3.6.7 =
* Fixed conditional being too strict [#34](https://github.com/JayWood/content-warning-v3/issues/34)
* Fixed plugin homepage link [#31](https://github.com/JayWood/content-warning-v3/issues/31)
* Removed uninstall hook for now - Options API needs to be updated
* Fixed denial toggle to actually remove denial text if it was once on, but now off.

= 3.6.6 =
* Fixed CSS issues for background images and css overrides

= 3.6.5 =
* Zero day ( 0 ) cookies should use sessions instead of NOT setting the cookie. [Issue #29](https://github.com/JayWood/content-warning-v3/issues/29)
* New filter for display condition - [See Wiki](https://github.com/JayWood/content-warning-v3/wiki/Dev-Documentation#hide-the-dialog-on-certain-pages-regardless-of-cookies) - [Issue #26](https://github.com/JayWood/content-warning-v3/issues/26)

= 3.6.4 =
* Fixed denial redirects. [Issue #28](https://github.com/JayWood/content-warning-v3/issues/28)
* Fixed multiple undefined index errors on admin
* Changed yes/no on post columns to locked dash-icon, less clutter
* Clean up meta saving logic
* Added @since tags for future development
* Better PHP documentation
* Add /lang directory for I18n
* Update Tested Up To version
* [Development Documentation](https://github.com/JayWood/content-warning-v3/wiki/Dev-Documentation)
* Passified all PHPcs complaints

= 3.6.3 =
* Category fix, fixes [#18](https://github.com/JayWood/content-warning-v3/issues/18)
* Alphabetize method names, because why not!?
* Few docblock changes

= 3.6.2 =
* Dialog re-sizing fixes.

= 3.6.1 =
* Cookie HOTFIX

= 3.6.0 =
* Split methods and hooks from main class file, will prevent overhead, also separates admin from front-end.
* Moved to use of cookie.js
* Created API file for methods.
* New filters & actions for developers
* Began development of API file, currently only support JS outputs.
* **NEW** Filters for content outputs, see `inc/api.php` more to come.
* Switched CSS priority, to allow custom css to override bg image and opacity
* Converted sass file to nested sass and uses classes instead of IDs
* [stacyk](https://github.com/stacyk) - Made buttons visible on popup at all times.
* [stacyk](https://github.com/stacyk) - CSS Fixes for new popup.
* New Popup coding, dropped colorbox in favor of my own popup code. ( Less bloat )
* BIG THANKS to Stacy for helping me with some initial CSS issues.

== Upgrade Notice ==
= 2.0 =
Adds a ton more features from v1 by rajeevan.  Along with a few security fixes.
