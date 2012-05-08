<?php
/*
Plugin Name: VeriteCo Timeline
Plugin URI: http://cardume.art.br/
Description: A simple shortcode to display the Timeline from http://timeline.verite.co/.
Version: 0.9.7
Author: Cardume
Author URI: http://cardume.art.br
License: AGPLv3
Text Domain: verite-timeline
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

define( 'VERITETIMELINE_URL', plugin_dir_url(__FILE__) );

add_action('init', 'verite_timeline_scripts');
function verite_timeline_scripts() {
	wp_enqueue_script('jquery');
	wp_register_script('verite-timeline-embed', plugin_dir_url( __FILE__).'js/timeline-embed.js', array('jquery'), false, TRUE);
}

add_action('init', 'verite_timeline_textdomain');
function verite_timeline_textdomain() {
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain('verite-timeline', false, $plugin_dir . '/languages/');
}

add_shortcode('timeline', 'verite_timeline_shortcode');
function verite_timeline_shortcode($atts, $content=null) {
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

	wp_enqueue_script('verite-timeline-embed');
	
	$timeline_css = plugin_dir_url( __FILE__).'css/timeline.css';
	
	$wp_language = get_bloginfo('language');
	switch($wp_language) {
		case 'pt-BR':
		case 'pt-PT':
			$timeline_src = plugin_dir_url( __FILE__).'js/locale/pt-br.js';
			break;
		case 'es-ES':
		case 'es-PE':
			$timeline_src = plugin_dir_url( __FILE__).'js/locale/es.js';
			break;
		case 'ko-KR':
			$timeline_src = plugin_dir_url( __FILE__).'js/locale/kr.js';
			break;
		case 'de-DE':
			$timeline_src = plugin_dir_url( __FILE__).'js/locale/de.js';
			break;
		case 'it-IT':
			$timeline_src = plugin_dir_url( __FILE__).'js/locale/it.js';
			break;
		case 'fr-FR':
			$timeline_src = plugin_dir_url( __FILE__).'js/locale/fr.js';
			break;
		case 'zh-CN':
			$timeline_src = plugin_dir_url( __FILE__).'js/locale/zh-ch.js';
			break;
		case 'zh-TW':
			$timeline_src = plugin_dir_url( __FILE__).'js/locale/zh-tw.js';
			break;
		default:
			$timeline_src = plugin_dir_url( __FILE__).'js/locale/en.js';
			break;
	}

	$shortcode = '
	<div id="timeline-embed"></div>
	<script type="text/javascript">// <![CDATA[
		var $ = jQuery;
		var timeline_config = {
			width: "' . $width . '", // OPTIONAL
			height: "' . $height . '", // OPTIONAL
			maptype: "' . $maptype . '", // OPTIONAL
			source: "' . $src . '",
			css: "' . $timeline_css . '",
			js: "' . $timeline_src . '"
		}
	// ]]></script>
	';

	return $shortcode;
}

/*
	TinyMCE
*/

add_action('media_buttons_context', 'verite_timeline_tinymce_button');
global $pagenow;
if($pagenow == 'post.php' || $pagenow == 'page.php' || $pagenow == 'page-new.php' || $pagenow == 'post-new.php') {
	add_action('admin_footer', 'verite_timeline_tinymce');
}

function verite_timeline_tinymce_button($context){
	global $pagenow;
    $is_post_edit_page = in_array($pagenow, array('post.php', 'page.php', 'page-new.php', 'post-new.php'));
    if(!$is_post_edit_page)
        return $context;

    $image_btn = VERITETIMELINE_URL . "/images/button-tinymce.png";
    $out = '<a href="#TB_inline?inlineId=add_timeline_form" class="thickbox" id="add_timeline" title="' . __('Insert Timeline', 'verite-timeline') . '"><img src="'.$image_btn.'" alt="' . __('Insert Timeline', 'verite-timeline') . '" /></a>';
    return $context . $out;
}

// TinyMCE Button for the shortcode
function verite_timeline_tinymce(){
    ?>
    <script type="text/javascript">
        function insertTimeline(){
            var data_src = jQuery('#timeline_data_src').val();
            var width = jQuery('#timeline_width').val();
            var height = jQuery('#timeline_height').val();
            var maptype = jQuery('#timeline_maptype').val();

            window.send_to_editor("[timeline src=\"" + data_src + "\" width=\"" + width + "\" height=\"" + height + "\" maptype=\"" + maptype + "\"]");
        }
    </script>

    <div id="add_timeline_form" style="display:none;">
        <div class="wrap">
            <div>
                <div style="padding:15px 15px 0 15px;">
                    <h3 style="color:#5A5A5A!important; font-family:Georgia,Times New Roman,Times,serif!important; font-size:1.8em!important; font-weight:normal!important;"><?php _e('Insert Timeline', 'verite-timeline'); ?></h3>
                    <span>
                        <?php _e('Configurate your Timeline and add it to your post', 'verite-timeline'); ?>
                    </span>
                </div>
                <div style="padding:15px 15px 0 15px;">
                	<table>
                		<tbody>
                			<tr>
                				<td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_data_src"><?php _e('Data source', 'verite-timeline'); ?></label></td>
                				<td style="padding: 0 0 10px;"><input type="text" id="timeline_data_src" size="75" /><br/>
                					<small><a href="http://timeline.verite.co/#fileformat" target="_blank"><?php _e('Learn how to create your timeline', 'verite-timeline'); ?></a></small></td>
                			</tr>
                			<tr>
                				<td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_width"><?php _e('Width', 'verite-timeline'); ?></label></td>
                				<td style="padding: 0 0 10px;"><input type="text" id="timeline_width" size="5" value="100%" /></td>
                			</tr>
                			<tr>
                				<td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_height"><?php _e('Height', 'verite-timeline'); ?></label></td>
                				<td style="padding: 0 0 10px;"><input type="text" id="timeline_height" size="5" value="650" /></td>
                			</tr>
                			<tr>
                				<td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_maptype"><?php _e('Maptype', 'verite-timeline'); ?></label></td>
                				<td style="padding: 0 0 10px;">
                					<select id="timeline_maptype">
                						<option value="toner">Stamen Maps: Toner</option>
                						<option value="toner-lines">Stamen Maps: Toner Lines</option>
                						<option value="toner-labels">Stamen Maps: Toner Labels</option>
                						<option value="watercolor">Stamen Maps: Watercolor</option>
                						<option value="sterrain">Stamen Maps: Terrain</option>
                						<option value="SATELLITE">Google Maps: Stallite</option>
                						<option value="ROADMAP">Google Maps: Roadmap</option>
                						<option value="TERRAIN">Google Maps: Terrain</option>
                						<option value="HYBRID">Google Maps: Hybrid</option>
                					</select><br/>
                					<small><a href="http://maps.stamen.com/" target="_blank"><?php _e('Learn more about the map styles', 'verite-timeline'); ?></a></small></td>
                				</td>
                			</tr>
                		</tbody>
                	</table>
                </div>
                <div style="padding:15px;">
					<input type="button" class="button-primary" value="<?php _e('Insert Timeline', 'verite-timeline'); ?>" onclick="insertTimeline();"/>
					<a class="button" style="color:#bbb;" href="#" onclick="tb_remove(); return false;"><?php _e('Cancel', 'verite-timeline'); ?></a>
                </div>
            </div>
        </div>
    </div>

    <?php
}
