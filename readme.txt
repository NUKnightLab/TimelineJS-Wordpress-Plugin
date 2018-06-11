=== Knight Lab Timeline ===
Contributors: miguelpeixe, zachwise, KnightLab, joegermuska
Donate link: http://knightlab.northwestern.edu/
Tags: timeline, shortcode, stamen, timeline.verite.co, verite, html5, KnightLab
Requires at least: 2.0.2
Tested up to: 4.9.4
Stable tag: 3.6.0.0

Use the incredible HTML5 Timeline developed by Knight Lab on your website. As easy as writing a shortcode.

== Description ==

A simple shortcode plugin to add the TimelineJS made by Knight Lab. Now updated to support TimelineJS3.

Supports custom width and height, [Google Spreadsheet and JSON data sources](http://timeline.knightlab.com/ "Learn how to create your data source") and many more.

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
* Belarusian
* Bulgarian
* Catalan
* Chinese
* Croatian / Hrvatski
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
* Frisian
* Galician
* Georgian
* German / Deutsch
* Greek
* Hebrew
* Hindi
* Hungarian
* Icelandic
* Indonesian
* Irish
* Italian
* Japanese
* Korean
* Latvian
* Lithuanian
* Luxembourgish
* Malay
* Myanmar
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
* Ukrainian
* Urdu



== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Learn how to create the Timeline source at http://timeline.knightlab.com/
1. Use the shortcode on your post/page: `[timeline src="Your source url here"]`

**Extra tip** - If you want do embed outside of a post, use the following code on your template:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`

Alternatively, you can use the TinyMCE button to create your own shortcode as well.


== Changelog ==
If you find this changelog out of date, you can assume that the plugin update is merely to pull in a new version of TimelineJS (especially if the plugin version number is 3.x.y.0)

The most up to date change log for TimelineJS itself can be found at https://github.com/NUKnightLab/TimelineJS3/blob/master/CHANGELOG

= 3.6.0.0 =
* Update to TimelineJS 3.6.0, which anonymizes IP addresses when tracking Timeline events in accordance with the GDPR.

= 3.5.4.0 =
* Catch up to latest release of TimelineJS, test on latest version of Wordpress.

= 3.3.16.0 =
* CSS styling fixes, including one affecting Wordpress plugin users who use the `.vcard` CSS class.

= 3.3.15.0 =
* Improvements in translations for Finnish, Hungarian, Swedish
* support more image URL formats for timenav thumbnails

= 3.3.14.0 =
* Update to TimelineJS 3.3.14 -- fixes Imgur bug
* Experimental: register a TimelineJS oembed provider. You can now embed a timeline just by getting the URL for "get link to preview" from https://timeline.knightlab.com and putting it in a post on a line by itself. We're not entirely clear why width/height parameters are not being honored.

= 3.3.11.2 =
* Minor TimelineJS3 version update
* Fixes to plugin deployment/working out kinks in update


= 3.3.11.2 =
* Minor TimelineJS3 version update
* Fixes to plugin deployment/working out kinks in update

= 3.3.10.0 =
* Major update: this plugin now supports the TimelineJS3 rewrite. To preserve backwards compatibility, you must include this in your shortcode to use the new version of Timeline: `version="timeline3"`. This will be done automatically if you use the "Add Timeline" button in the editing interface.


= 2.35.6.0 =
* Revert animation changes introduced in 2.35.5

= 2.35.5.0 =
* Fix URL linking regression introduced in 2.35.3
* Animation optimizations from #681

= 2.35.4.0 =
* Fix Stamen map tile URL bug

= 2.35.3.0 =
* Many updates to localization: new and changed languages.

= 2.35.2 =
* Fix mobile display bug.

= 2.35.0 =
* Fix date initialization process to address Firefox bug in UK/Ireland (https://github.com/NUKnightLab/TimelineJS/issues/718)

= 2.34.0 =
* Remove HTTPS URL rewriting for older IE.
* don't do analytics on https
* Check to make sure that every slide has a start date, so that people get a clear warning if the spreadsheet header has been changed.
* fix jquery version check, again. (should accept jquery 2, although TimelineJS has not been tested with jquery 2) cf. #551
* Update ko.js translation file
* Update fa.js translation file


= 2.33.1.0 =
* Update to TimelineJS 2.33.1: fix bug handling maps.google media URLs; minor updates to zh-cn localization file.

= 2.33.0.0 =
* Update to TimelineJS 2.33.0: better handle changes to Google Maps and Spreadsheet URLs; add 'W' token for date format; accept *.bmp as image URL; fix jQuery version check; fix untagify; more permissive on iframe markup; treat Google Streetview API images as images, not maps; set maxheight on soundcloud embeds; crush png files.

= 2.32.0.0 =
* Update to TimelineJS 2.32.0: Stop YouTube players when slide changes; Better method for determining embed path root; Check for iframe and blockquote media before other url tests; Add languages: 'hr' (Croatian), 'uk' (Ukrainian); minor fixes to language files for 'fi' (Finnish) 'sl' (Slovenian). Plugin-specific: add 'OpenStreetMap' option to map-type menu in shortcode builder.

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

*	**src**: Data source url, typically to a Google Spreadsheet as [documented on the TimelineJS website](https://timeline.knightlab.com/docs/using-spreadsheets.html). Alternatively, you may use [JSON](http://timeline.knightlab.com/docs/json-format.html) to configure your timeline. **[required]**
*	**width**: Custom width *(default is 100%)*
*	**height**: Custom height *(default is 650)*
*	**version**: Optional. If set to 'timeline3', then the current version of TimelineJS will be used. If omitted, TimelineJS 2.35.6 will be used. This version of TimelineJS is no longer supported, but is preserved for backwards compatibility.
