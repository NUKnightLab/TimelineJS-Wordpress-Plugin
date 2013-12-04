# TimelineJS 
## Document history with TimelineJS
Contributors: miguelpeixe, zachwise
Tags: timeline, shortcode, KnightLab, NorthwesternUniversity
Requires at least: 2.0.2
Tested up to: 3.7.1
Stable tag: 2.26.5

Use the [Northwestern University Knight Lab](http://KnightLab.Northwestern.edu)'s [TimelineJS](http://timeline.knightlab.com) on your Wordpress site. As easy as writing a shortcode.

## Description

There are lots of timeline tools on the web but they are almost all either
hard on the eyes or hard to use. Create timelines that are at the same time
beautiful and intuitive for users

TimelineJS is great for pulling in media from different sources. Just throw in 
a link from Twitter, YouTube, Flickr, Vimeo, Google Maps or SoundCloud and
TimelineJS will format it to fit perfectly. More media types will be supported
in the future.

Creating one is as easy as filling in a Google spreadsheet. If you want to take more control, you can write JSON configuration.

To embed your timeline use the button located at the post content editor (TinyMCE).

**You can also embed the Timeline on your post using this shortcode :**
`[timeline src="Your source url here"]`

**TIP** - If you want to embed outside of a post, use the following code:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`


## Installation

1. Upload the plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Learn how to create the TimelineJS source at http://timeline.knightlab.com
1. Use the shortcode on your post/page: `[timeline src="Your source url here"]`

**Extra tip** - If you want to embed outside of a post, use the following code on your template:
`<?php echo do_shortcode('[timeline src="Your source url here"]'); ?>`

## File Formats

### Google Docs:

If you don’t want to mess with JSON, fire up Google Docs and build your
timeline in a spreadsheet. It’s as simple as dropping a date, text, and links
into the appropriate columns in TimelineJS’s template.

You can find the template here: [TimelineJS Google Spreadsheet Template](https://docs.google.com/a/digitalartwork.net/previewtemplate?id=0AppSVxABhnltdEhzQjQ4MlpOaldjTmZLclQxQWFTOUE&mode=public)

There are only a couple things you need to know in order to create a timeline
using Google Docs:

  1. Don't delete or change the header row in any way.
  
  2. Don't have any blank rows in your spreadsheet. 
  
  3. Make the spreadsheet public:   
	Google Docs are automatically set to private but the spreadsheet must be
	public.
	
	Click the blue “Share” button on the top right-hand corner. In the “Share
	settings” window, you’ll see the private setting of the spreadsheet: click
	“Change...”. In the Visibility options window, choose “Public on the Web” and
	save.

  4. Publish to the Web  
	Under the File menu, select “Publish to the Web.”
	
	In the next window, check the box next to “Automatically republish when
	changes are made.” Uncheck all other boxes. Click “start publishing.” This
	will give you the URL to embed in your HTML file.

  5. Copy/paste the Web URL into the 'src' in your short code.
	After you publish the spreadsheet, Google Docs will generate a link to the
	file. Copy the link for the Web Page option (as opposed to PDF, HTML, XLS,
	etc.), then paste it into the 'src' attribute in your shortcode.


## Shortcode Options
Here are some of the options you can set in the config.


###Start at End 
`start_at_end`
set to true to start the timeline on the last date.
*default is false*

###Start at Slide 
`start_at_slide`
You can tell TimelineJS to start at a specific slide number
*default is 0*

###Start Zoom Adjust
`start_zoom_adjust`
This will tweak the default zoom level. Equivilent to pressing the zoom in or zoom out button the specified number of times. Negative numbers zoom out.
*default is 0*

###Hash Bookmark 
`hash_bookmark`
set to true to allow bookmarking slides using the hash tag
*default is false*

###Debug 
`debug`
Will log events etc to the console.
*default is false*


###Map Style Types 
Due to recent changes to the Google Maps API, you need a [API Key](https://developers.google.com/places/documentation/#Authentication) in order to use custom map types.
`gmap_key:`
*required in order to use maptype*

`maptype:`
* [Stamen Maps ](maps.stamen.com)
* `toner`
* `toner-lines`
* `toner-labels`
* `watercolor`
* `sterrain`
		
* Google Maps
* `ROADMAP`
* `TERRAIN`
* `HYBRID`
* `SATELLITE`

###Font Options 
`font:`
* `Arvo-PTSans`
* `Merriweather-NewsCycle`
* `PoiretOne-Molengo`
* `PTSerif-PTSans`
* `DroidSerif-DroidSans`
* `Lekton-Molengo`
* `NixieOne-Ledger`
* `AbrilFatface-Average`
* `PlayfairDisplay-Muli`
* `Rancho-Gudea`
* `Bevan-PotanoSans`
* `BreeSerif-OpenSans`
* `SansitaOne-Kameron`
* `Pacifico-Arimo`
* Or make your own

### Language
`lang`
Localization
*default is `en` English*
Languages available:
* `en` *English*
* `en-24hr` *English (24-hour time)*
* `af` *Afrikaans*
* `ar` *Arabic*
* `hy` *Armenian*
* `eu` *Basque*
* `bg` *Bulgarian*
* `ca` *Catalan*
* `zh-ch` *Chinese*
* `cz` *Czech*
* `da` *Danish*
* `nl` *Dutch*
* `eo` *Esperanto*
* `et` *Estonian*
* `fo` *Faroese*
* `fi` *Finnish*
* `fr` *French*
* `gl` *Galician*
* `ka` *Georgian*
* `de` *German / Deutsch*
* `el` *Greek*
* `he` *Hebrew*
* `hu` *Hungarian*
* `is` *Icelandic*
* `id` *Indonesian*
* `it` *Italian*
* `ja` *Japanese*
* `ko` *Korean*
* `lv` *Latvian*
* `lb` *Luxembourgish*
* `ms` *Malay*
* `ne` *Nepali*
* `no` *Norwegian*
* `pl` *Polish*
* `pt` *Portuguese*
* `pt-br` *Portuguese (Brazilian)*
* `rm` *Romansh*
* `ru` *Russian*
* `sr-cy` *Serbian - Cyrillic*
* `sr` *Serbian - Latin*
* `si` *Sinhalese*
* `sk` *Slovak*
* `sl` *Slovenian*
* `es` *Spanish*
* `sv` *Swedish*
* `tl` *Tagalog*
* `zh-tw` *Taiwanese*
* `ta` *Tamil*
* `te` *Telugu*
* `tr` *Turkish*

Help us add more. Grab a copy of a language file and replace it with your language [Example language file](https://github.com/NUKnightLab/TimelineJS/blob/master/source/js/Core/Language/locale/en.js) and find your language's [two letter code here](http://spreadsheets.google.com/pub?key=p9pdwsai2hDMsLkXsoM05KQ&gid=1)


####Font Combination Preview:
![Font Combination Preview](http://timeline.knightlab.com/static/img/make/font-options.png)
  
## Best practices

Tips and tricks to best utilize TimelineJS

  1. Keep it light - don’t get bogged down by text or other elements
  2. Pick stories that have a strong chronological narrative. It does not work well for stories that need to jump around in the timeline.
  3. Include events that build up to major occurrences, not just the major events.
  4. Don't overwhelm the user. A timeline with hundreds of events is probably not the best use of the format.
  
## License
This Source Code Form is subject to the terms of the Mozilla Public
License, v. 2.0. If a copy of the MPL was not distributed with this
file, You can obtain one at http://mozilla.org/MPL/2.0/.

## Changelog
### 2.26.3 ###
* Update Timeline to the latest version

### 2.11.1 ###
* Update Timeline to the latest version

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
