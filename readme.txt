=== Knight Lab Timeline ===
Contributors: miguelpeixe, zachwise, KnightLab
Donate link: http://knightlab.northwestern.edu/
Tags: timeline, shortcode, stamen, timeline.verite.co, verite, html5, KnightLab
Requires at least: 2.0.2
Tested up to: 3.9.0
Stable tag: 2.31.0.0

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
* Arabic
* Armenian
* Basque
* Bulgarian
* Catalan
* Chinese
* Czech
* Danish
* Dutch
* English
* English (24-hour time)
* Esperanto
* Estonian
* Faroese
* Farsi
* Finnish
* French
* Galician
* Georgian
* German
* Greek
* Hebrew
* Hungarian
* Icelandic
* Indonesian
* Italian
* Japanese
* Korean
* Latvian
* Lithuanian
* Luxembourgish
* Malay
* Nepali
* Norwegian
* Polish
* Portuguese
* Portuguese (Brazilian)
* Romanian
* Romansh
* Russian
* Serbian - Cyrillic
* Serbian - Latin
* Sinhalese
* Slovak
* Slovenian
* Spanish
* Swedish
* Tagalog
* Tamil
* Taiwanese
* Telugu
* Thai
* Turkish



== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Learn how to create the Timeline source at http://timeline.knightlab.com/
1. Use the shortcode on your post/page: `[timeline src="Your source url here"]`

**Extra tip** - If you want do embed outside of a post, use the following code on your template:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`

Alternatively, you can use the TinyMCE button to create your own shortcode as well. 


== Changelog ==
= 2.31.0.0 =
* Update to TimelineJS 2.31.0: Add languages: 'ro' (Romanian), 'th' (Thai); minor fixes to language files for 'es' (Spanish) 'fa' (Farsi), 'hu' (Hungarian), 'no' (Norwegian); add OpenStreetMap as a map option ('osm'); Support '.svg' as an image media type; support custom thumbnails when no media is specified; clearer warning about "compatibility mode" to IE users.


= 2.30.0.0 =
* Update to TimelineJS 2.30.0: Fix language code for 'zh-cn' (Chinese); add 'fa' (Farsi); Move 'remove' function from Array.prototype to a util method to avoid adverse affects on other JS code.

= 2.28.1.2 =
* Incremented version for semi-separate versioning with TimelineJS

= 2.28.1.1 =
* Initial time using deployment script

= 2.28.1 =
* Modified to match current TimelineJS version number

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
