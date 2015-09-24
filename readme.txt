=== Knight Lab Timeline 3.x ===
Contributors: miguelpeixe, zachwise, KnightLab
Donate link: http://knightlab.northwestern.edu/
Tags: timeline, shortcode, html5, KnightLab
Requires at least: 2.0.2
Tested up to: 4.1
Stable tag: 3.3.2.0

Use Northwestern University Knight Lab's TimelineJS on your wordpress site. As easy as writing a shortcode. Updated for TimelineJS3.

== Description ==

A simple shortcode plugin to add the TimelineJS made by Knight Lab.

**NOTE:** In September 2015, a substantial rewrite of TimelineJS was released. This plugin works with that version of Timeline. Another
[Wordpress plugin](https://wordpress.org/plugins/knight-lab-timelinejs/) exists which uses the older version of Timeline. This
plugin was created so as not to forcibly upgrade people using the older version of Timeline. However, in most cases, users of the previous plugin can install this one and deactivate that one and everything should work OK.

Learn how to create a Timeline at http://timeline.knightlab.com/

To embed your timeline use the button located at the post content editor (TinyMCE).

**You can also embed the Timeline on your post using this shortcode :**
`[timeline src="Your source url here"]`

The source URL can either be to a [published Google Spreadsheet](http://timeline.knightlab.com/docs/using-spreadsheets.html) or to a file in the [TimelineJS3 JSON format](http://timeline.knightlab.com/docs/json-format.html).

**TIP** - If you want to embed outside of a post, use the following code:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`

== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Learn how to create the Timeline source at http://timeline.knightlab.com/
1. Use the shortcode on your post/page: `[timeline src="Your source url here"]`

**Extra tip** - If you want do embed outside of a post, use the following code on your template:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`

Alternatively, you can use the TinyMCE button to create your own shortcode as well.


== Changelog ==
The most up to date change log for TimelineJS itself can be found at https://github.com/NUKnightLab/TimelineJS/blob/master/CHANGELOG

Version numbers for this plugin primarily align with versions of TimelineJS. This is why we start at 3.3.2.0. The first three parts of the version number match the version of TimelineJS; the last number is for changes to this plugin when the TimelineJS version doesn't change.

= 3.3.2.0 =
* Initial release of Wordpress plugin for Timeline JS3

== Shortcode options ==

`[timeline width="800" height="600" src="Your source url here"]`

*	**src**: Data source url, either to a [published Google spreadsheet](http://timeline.knightlab.com/docs/using-spreadsheets.html#publishing) or [properly formatted JSON file](http://timeline.knightlab.com/docs/json-format.html). **[required]**
*	**width**: Custom width in percentage or pixels *(default is 100%)*
*	**height**: Custom height in pixels *(default is 650)*
