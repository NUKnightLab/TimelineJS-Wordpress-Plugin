VéritéCo Timeline
===============

Contributors: miguelpeixe, zachwise
Tags: timeline, shortcode, stamen, timeline.verite.co, verite, html5
Requires at least: 2.0.2
Tested up to: 3.3.2
Stable tag: 0.9.7

Use the incredible HTML5 Timeline developed by VéritéCo on your website. As easy as writing a shortcode.

Description
-----------

A simple shortcode plugin to add the Timeline made by [VéritéCo](http://verite.co/).

Supports custom width and height, [custom map styles by Stamen](http://maps.stamen.com/#content "Check the website for all the possible styles"), [Google Spreadsheet and JSON data sources](http://timeline.verite.co/#fileformat "Learn how to create your data source") and many more.

Checkout how to create your amazing Timeline at http://timeline.verite.co/

To embed your timeline use the button located at the post content editor (TinyMCE).

**You can also embed the Timeline on your post using this shortcode :**
`[timeline src="Your source url here"]`

**TIP** - If you want to embed outside of a post, use the following code:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`

### Supported languages ###

*	English
*	Brazilian Portuguese
*	French
*	Spanish
*	German - Deutsch
*	Italian
*	Korean
*	Chinese
*	Taiwanese

Installation
------------

1. Upload the plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Learn how to create the Timeline source at http://timeline.verite.co/#fileformat
1. Use the shortcode on your post/page: `[timeline src="Your source url here"]`

**Extra tip** - If you want do embed outside of a post, use the following code on your template:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`


Shortcode options
-----------------

`[timeline width="800" height="600" maptype="watercolor" src="Your source url here"]`

* **src**: Data source url, based on [Verite Timeline File Formats](http://timeline.verite.co/#fileformat "Learn how to create your data source"). **[required]**
* **width**: Custom width *(default is 100%)*
* **height**: Custom height *(default is 650)*
* **maptype**: Custom maptype, based on [Stamen custom map styles](http://maps.stamen.com/#content "Check his website for all the styles") and Google Maps default tiles. Possibilities are:
  * Stamen Maps: `toner`, `toner-lines`, `toner-labels`, `sterrain` and `watercolor` *(default is `toner`)*
  * Google Maps: `ROADMAP`, `TERRAIN`, `HYBRID`, `SATELLITE`


Changelog
---------

### 0.9.7 ###
* Update Timeline to the latest version

### 0.9.6 ###
* Update Timeline to the latest version

### 0.9.5 ###
* Update Timeline to the latest version

### 0.9.4 ###
* Local storing Timeline files
* Adding more map style options for TinyMCE

### 0.9.3 ###
* l18n support for TinyMCE
* Brazilian Portuguese translation for TinyMCE

### 0.9.2 ###
* Added TinyMCE button

### 0.9.1 ###
* Small bugfix for default width/height

### 0.9 ###
* Language support based on WordPress locale:
  * Brazilian Portuguese
  * French
  * Spanish
  * German - Deutsch
  * Italian
  * Korean
  * Chinese
  * Taiwanese

### 0.8 ###
* First stable release.
