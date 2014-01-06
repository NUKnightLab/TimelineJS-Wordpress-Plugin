=== Knight Lab Timeline ===
Contributors: miguelpeixe, zachwise, KnightLab
Tags: timeline, shortcode, stamen, timeline.verite.co, verite, html5, KnightLab
Requires at least: 2.0.2
Tested up to: 3.7.1
Stable tag: 1.0.0

Use the incredible HTML5 Timeline developed by Knight Lab on your website. As easy as writing a shortcode.

== Description ==

A simple shortcode plugin to add the TimelineJS made by Knight Lab.

Supports custom width and height, [custom map styles by Stamen](http://maps.stamen.com/#content "Check the website for all the possible styles"), [Google Spreadsheet and JSON data sources](http://timeline.knightlab.com/ "Learn how to create your data source") and many more.

Checkout how to create your amazing Timeline at http://timeline.knightlab.com/

To embed your timeline use the button located at the post content editor (TinyMCE).

**You can also embed the Timeline on your post using this shortcode :**
`[timeline src="Your source url here"]`

**TIP** - If you want to embed outside of a post, use the following code:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`

**Supported languages**
* Afrikaans
* Arabic (beta)
* Bulgarian
* Catalan
* Czech
* Danish
* German / Deutsch
* Greek
* English
* Spanish
* Basque/ Euskara
* Finnish
* Faroese
* French
* Galician
* Hungarian
* Armenian
* Indonesian
* Icelandic
* Italian
* Hebrew (beta)
* Japanese
* Georgian
* Korean
* Latvian
* Dutch
* Norwegian
* Polish
* Brazilian Portuguese
* Portuguese
* Russian
* Slovak
* Slovenian
* Serbian (Cyrillic)
* Serbian (Latin)
* Swedish
* Tamil
* Tagalog
* Turkish
* Chinese
* Taiwanese


== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Learn how to create the Timeline source at http://timeline.knightlab.com/
1. Use the shortcode on your post/page: `[timeline src="Your source url here"]`

**Extra tip** - If you want do embed outside of a post, use the following code on your template:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`

Alternatively, you can use the TinyMCE button to create your own shortcode as well. 

== Changelog ==
= 1.0.0 =
* First stable release


== Shortcode options ==

`[timeline width="800" height="600" maptype="watercolor" src="Your source url here"]`

*	**src**: Data source url, based on [Verite Timeline File Formats](http://timeline.verite.co/#fileformat "Learn how to create your data source"). **[required]**
*	**width**: Custom width *(default is 100%)*
*	**height**: Custom height *(default is 650)*
*	**maptype**: Custom maptype, based on [Stamen custom map styles](http://maps.stamen.com/#content "Check his website for all the styles") and Google Maps default tiles. Possibilities are:
	* Stamen Maps: `toner`, `toner-lines`, `toner-labels`, `sterrain` and `watercolor` *(default is `toner`)*
	* Google Maps: `ROADMAP`, `TERRAIN`, `HYBRID`, `SATELLITE`
