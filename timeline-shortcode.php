<?php
/*
Plugin Name: Timeline Verite Shortcode
Plugin URI: http://cardume.art.br/
Description: A simple shortcode to display the Timeline from http://timeline.verite.co/.
Version: 0.8
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
			'width'=> 700,
			'height'=> 800,
			'maptype'=> 'toner',
			'src'=> false,
		), $atts
	));

	if(!$src) return false;

	$shortcode = '
	<div id="timeline-embed"></div>
	<script type="text/javascript">
		var $ = jQuery;
		var timeline_config = {
			width: ' . $width . ', // OPTIONAL
			height: ' . $height . ', // OPTIONAL
			maptype: "' . $maptype . '", // OPTIONAL
			source: "' . $src . '"
		}
	</script>
	';

	return $shortcode;
}