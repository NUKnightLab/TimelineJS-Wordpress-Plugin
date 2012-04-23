<?php
/*
Plugin Name: Verite Timeline
Plugin URI: http://cardume.art.br/
Description: A simple shortcode to display the Timeline from http://timeline.verite.co/.
Version: 0.9.1
Author: Cardume
Author URI: http://cardume.art.br
License: AGPLv3
*/

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

add_action('init', 'timeline_verite_scripts');
function timeline_verite_scripts() {
	wp_enqueue_script('jquery');
	wp_register_script('timeline-verite-embed', 'http://veritetimeline.appspot.com/latest/timeline-embed.js', array('jquery'), false, TRUE);
	wp_enqueue_script('timeline-verite-embed');
}

add_shortcode('timeline', 'timeline_verite_shortcode');
function timeline_verite_shortcode($atts, $content=null) {
	extract(shortcode_atts(
		array(
			'title' => '',
			'width'=> '100%',
			'height'=> 650,
			'maptype'=> 'toner',
			'src'=> false,
		), $atts
	));

	if(!$src) return false;

	$wp_language = get_bloginfo('language');
	switch($wp_language) {
		case 'pt-BR':
		case 'pt-PT':
			$timeline_src = 'http://veritetimeline.appspot.com/latest/locale/pt-br.js';
			break;
		case 'es-ES':
		case 'es-PE':
			$timeline_src = 'http://veritetimeline.appspot.com/latest/locale/es.js';
			break;
		case 'ko-KR':
			$timeline_src = 'http://veritetimeline.appspot.com/latest/locale/kr.js';
			break;
		case 'de-DE':
			$timeline_src = 'http://veritetimeline.appspot.com/latest/locale/de.js';
			break;
		case 'it-IT':
			$timeline_src = 'http://veritetimeline.appspot.com/latest/locale/it.js';
			break;
		case 'fr-FR':
			$timeline_src = 'http://veritetimeline.appspot.com/latest/locale/fr.js';
			break;
		case 'zh-CN':
			$timeline_src = 'http://veritetimeline.appspot.com/latest/locale/zh-ch.js';
			break;
		case 'zh-TW':
			$timeline_src = 'http://veritetimeline.appspot.com/latest/locale/zh-tw.js';
			break;
		default:
			$timeline_src = 'http://veritetimeline.appspot.com/latest/locale/en.js';
			break;
	}

	$shortcode = '
	<div id="timeline-embed"></div>
	<script type="text/javascript">
		var $ = jQuery;
		var timeline_config = {
			width: "' . $width . '", // OPTIONAL
			height: "' . $height . '", // OPTIONAL
			maptype: "' . $maptype . '", // OPTIONAL
			source: "' . $src . '",
			js: "' . $timeline_src . '"
		}
	</script>
	';

	return $shortcode;
}
