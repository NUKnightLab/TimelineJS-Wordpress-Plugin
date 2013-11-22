<?php
/*
Plugin Name: VeriteCo TimelineS
Plugin URI: http://timeline.verite.co
Description: A simple shortcode to display TimelineJS.
*/

/*
This Source Code Form is subject to the terms of the Mozilla Public
License, v. 2.0. If a copy of the MPL was not distributed with this
file, You can obtain one at http://mozilla.org/MPL/2.0/.
*/

define( 'VERITETIMELINE_URL', plugin_dir_url(__FILE__) );

add_action('init', 'verite_timeline_scripts');
function verite_timeline_scripts() {
    wp_enqueue_script('jquery');
    wp_register_script('verite-timeline-embed', plugin_dir_url( __FILE__).'js/storyjs-embed.js', array('jquery'), false, TRUE);
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
            'width' => '100%',
            'height' => 650,
            'font' => '',
            'maptype' => 'toner',
            'lang' => 'en',
            'src'=> $src,
            'start_at_end' => 'false',
            'hash_bookmark' => 'false',
            'debug' => 'false',
            'start_at_slide' => null,
            'start_zoom_adjust' => null,
                ), $atts
        ));

        if(!$src) return false;

        wp_enqueue_script('verite-timeline-embed');
        
        $shortcode = '
    <div id="timeline-embed"></div>
    <script type="text/javascript">// <![CDATA[
        var timeline_config = {
            width: "' . $width .'",
            height: "' . $height . '",
            source: "' . $src . '",
            embed_id: "timeline-embed",
            start_at_end: ' . $start_at_end . ',
            start_at_slide: "' . $start_at_slide . '",
            start_zoom_adjust: "' . $start_zoom_adjust . '",
            hash_bookmark: ' . $hash_bookmark .',
            font: "' . $font . '",
            debug: ' . $debug . ',
            lang: "' . $lang . '",
            maptype: "' . $maptype . '",
        }
        // ]]></script>
        ';
        return $shortcode;
}

/*
    TinyMCE
*/

add_action('media_buttons_context', 'verite_timeline_tinymce_button');

// Add content for creating a timeline
add_action('admin_footer', 'verite_timeline_tinymce');

// TinyMCE Button for the shortcode
function verite_timeline_tinymce_button($context) {
  
  $img = VERITETIMELINE_URL . "/button-tinymce.png";
  $container_id = 'add_timeline_form';
  $title = __('Insert Timeline', 'verite-timeline');

  //append the icon
  $context .= "<a class='thickbox' title='{$title}' id='add_timeline'
    href='#TB_inline?width=400&inlineId={$container_id}'>
    <img src='{$img}' /></a>";
  
  return $context;
}

function verite_timeline_tinymce() {
?>
<script type="text/javascript">
        function insertTimeline(){
            var data_src = jQuery('#timeline_data_src').val();
            var width = jQuery('#timeline_width').val();
            var height = jQuery('#timeline_height').val();
            var maptype = jQuery('#timeline_maptype').val();
            var lang = jQuery('#timeline_lang').val();

            window.send_to_editor("[timeline src=\"" + data_src + "\" width=\"" + width + "\" height=\"" + height + "\" maptype=\"" + maptype + "\" lang=\"" + lang + "\" ]");
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
                            <tr>
                                <td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_maptype"><?php _e('Maptype', 'verite-timeline'); ?></label></td>
                                <td style="padding: 0 0 10px;">
                                    <select id="timeline_lang">
                                        <option value="en">English</option>
                                        <option value="en-24hr">English (24-hour time)</option>
                                        <option value="af">Afrikaans</option>
                                        <option value="ar">Arabic</option>
                                        <option value="hy">Armenian</option>
                                        <option value="eu">Basque</option>
                                        <option value="bg">Bulgarian</option>
                                        <option value="ca">Catalan</option>
                                        <option value="zh-ch">Chinese</option>
                                        <option value="cz">Czech</option>
                                        <option value="da">Danish</option>
                                        <option value="nl">Dutch</option>
                                        <option value="eo">Esperanto</option>
                                        <option value="et">Estonian</option>
                                        <option value="fo">Faroese</option>
                                        <option value="fi">Finnish</option>
                                        <option value="fr">French</option>
                                        <option value="gl">Galician</option>
                                        <option value="ka">Georgian</option>
                                        <option value="de">German / Deutsch</option>
                                        <option value="el">Greek</option>
                                        <option value="he">Hebrew</option>
                                        <option value="hu">Hungarian</option>
                                        <option value="is">Icelandic</option>
                                        <option value="id">Indonesian</option>
                                        <option value="it">Italian</option>
                                        <option value="ja">Japanese</option>
                                        <option value="ko">Korean</option>
                                        <option value="lv">Latvian</option>
                                        <option value="lb">Luxembourgish</option>
                                        <option value="ms">Malay</option>
                                        <option value="no">Norwegian</option>
                                        <option value="pl">Polish</option>
                                        <option value="pt">Portuguese</option>
                                        <option value="pt-br">Portuguese (Brazilian)</option>
                                        <option value="rm">Romansh</option>
                                        <option value="ru">Russian</option>
                                        <option value="sr-cy">Serbian - Cyrillic</option>
                                        <option value="sr">Serbian - Latin</option>
                                        <option value="si">Sinhalese</option>
                                        <option value="sk">Slovak</option>
                                        <option value="sl">Slovenian</option>
                                        <option value="es">Spanish</option>
                                        <option value="sv">Swedish</option>
                                        <option value="ta">Tamil</option>
                                        <option value="tl">Tagalog</option>
                                        <option value="te">Telugu</option>
                                        <option value="tr">Turkish</option>
                                        <option value="zh-tw">Taiwanese</option>
                                    </select><br/>
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