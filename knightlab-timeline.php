<?php
/**
 * Plugin Name: Knight Lab TimelineJS
 * Plugin URI: http://timeline.knightlab.com/
 * Description: A simple shortcode to display TimelineJS.
 * Version: 2.35.2.0
 * Author: Knight Lab
 * Author URI: http://knightlab.northwestern.edu/
 * License: Mozilla Public License, v. 2.0
 */


/*
This Source Code Form is subject to the terms of the Mozilla Public
License, v. 2.0. If a copy of the MPL was not distributed with this
file, You can obtain one at http://mozilla.org/MPL/2.0/.
*/

define( 'KL_TIMELINE_URL', plugin_dir_url(__FILE__) );

add_action('init', 'kl_timeline_scripts');
function kl_timeline_scripts() {
    wp_enqueue_script('jquery');
    wp_register_script('kl-timeline-embed', plugin_dir_url( __FILE__).'js/storyjs-embed.js', array('jquery'), false, TRUE);
}

add_action('init', 'kl_timeline_textdomain');
function kl_timeline_textdomain() {
    $plugin_dir = basename(dirname(__FILE__));
    load_plugin_textdomain('kl-timeline', false, $plugin_dir . '/languages/');
}

add_shortcode('timeline', 'kl_timeline_shortcode');
function kl_timeline_shortcode($atts, $content=null) {
        extract(shortcode_atts(
                array(
            'title' => '',
            'width' => '100%',
            'height' => 650,
            'font' => '',
            'maptype' => 'toner',
            'lang' => 'en',
            'src'=> '',
            'start_at_end' => 'false',
            'hash_bookmark' => 'false',
            'debug' => 'false',
            'start_at_slide' => null,
            'start_zoom_adjust' => null,
                ), $atts
        ));

        if(!$src) return false;

        wp_enqueue_script('kl-timeline-embed');
        $js_path = plugin_dir_url( __FILE__).'js/timeline-min.js';
        $css_path = plugin_dir_url( __FILE__).'css/timeline.css';

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
            css: "' . $css_path . '",
            js: "' . $js_path . '"
        }
        // ]]></script>
        ';
        return $shortcode;
}

/*
    TinyMCE
*/

add_action('media_buttons_context', 'kl_timeline_tinymce_button');

// Add content for creating a timeline
add_action('admin_footer', 'kl_timeline_tinymce');

// TinyMCE Button for the shortcode
function kl_timeline_tinymce_button($context) {
  
  $img = KL_TIMELINE_URL . "knight-diamond.png";
  $container_id = 'add_timeline_form';
  $title = __('Insert Timeline', 'kl-timeline');

  //append the icon
  $context .= "<a class='thickbox button' style='background: url({$img}) no-repeat 3px 3px; padding-left: 20px' title='{$title}' id='add_timeline'
    href='#TB_inline?width=600&height=495&inlineId={$container_id}'> Add Timeline</a>";
  
  return $context;
}

function kl_timeline_tinymce() {
?>
<script type="text/javascript">
        function insertTimeline(){
            var data_src = jQuery('#timeline_data_src').val();
            var width = jQuery('#timeline_width').val();
            var height = jQuery('#timeline_height').val();
            var maptype = jQuery('#timeline_maptype').val();
            var lang = jQuery('#timeline_lang').val();
            var font = jQuery('#timeline_font').val();

            window.send_to_editor("[timeline src=\"" + data_src + "\" width=\"" + width + "\" height=\"" + height + "\" font=\"" + font + "\" maptype=\"" + maptype + "\" lang=\"" + lang + "\" ]");
        }
    </script>

    <div id="add_timeline_form" style="display:none;" class="thickbox" >
        <div class="wrap">
            <div>
                <div style="padding:15px 15px 0 15px;">
                    <h3 style="color:#5A5A5A!important; font-family:Georgia,Times New Roman,Times,serif!important; font-size:1.8em!important; font-weight:normal!important;"><?php _e('Insert Timeline', 'kl-timeline'); ?></h3>
                    <span>
                        <?php _e('Configurate your Timeline and add it to your post', 'kl-timeline'); ?>
                    </span>
                </div>
                <div style="padding:15px 15px 0 15px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_data_src"><?php _e('Data source', 'kl-timeline'); ?></label></td>
                                <td style="padding: 0 0 10px;"><input type="text" id="timeline_data_src" size="75" style="width:450px;"/><br/>
                                    <small><a href="http://timeline.knightlab.com/" target="_blank"><?php _e('Learn how to create your timeline', 'kl-timeline'); ?></a></small></td>
                            </tr>
                            <tr>
                                <td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_width"><?php _e('Width', 'kl-timeline'); ?></label></td>
                                <td style="padding: 0 0 10px;"><input type="text" id="timeline_width" size="5" value="100%" /></td>
                            </tr>
                            <tr>
                                <td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_height"><?php _e('Height', 'kl-timeline'); ?></label></td>
                                <td style="padding: 0 0 10px;"><input type="text" id="timeline_height" size="5" value="650" /></td>
                            </tr>
                            <tr>
                                <td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_font"><?php _e('Fonts', 'kl-timeline'); ?></label></td>
                                <td style="padding: 0 0 10px;">
                                    <select id="timeline_font">
                                        <option value="Bevan-PotanoSans">Bevan & Potano Sans</option>
                                        <option value="Georgia-Helvetica">Georgia & Helvetica Neue</option>
                                        <option value="Merriweather-NewsCycle">Merriweather & News Cycle</option>
                                        <option value="NewsCycle-Merriweather">News Cycle & Merriweather</option>
                                        <option value="PoiretOne-Molengo">Poiret One & Molengo</option>
                                        <option value="Arvo-PTSans">Arvo & PT Sans</option>
                                        <option value="PTSerif-PTSans">PT Serif & PT Sans</option>
                                        <option value="DroidSerif-DroidSans">Droid Serif & Droid Sans</option>
                                        <option value="Lekton-Molengo">Lekton & Molengo</option>
                                        <option value="NixieOne-Ledger">Nixie One & Ledger</option>
                                        <option value="AbrilFatface-Average">Abril Fatface & Average</option>
                                        <option value="PlayfairDisplay-Muli">Playfair Display & Muli</option>
                                        <option value="Rancho-Gudea">Rancho & Gudea</option>
                                        <option value="BreeSerif-OpenSans">Bree Serif & Open Sans</option>
                                        <option value="SansitaOne-Kameron">Sansita One & Kameron</option>
                                        <option value="Pacifico-Arimo">Pacifico & Arimo</option>
                                        <option value="PT">PT Sans & PT Narrow & PT Serif</option>
                                    </select><br/>
                                    <small><a href="http://timeline.knightlab.com/static/img/make/font-options.png" target="_blank"><?php _e('Preview the font combinations', 'kl-timeline'); ?></a></small></td>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_maptype"><?php _e('Maptype', 'kl-timeline'); ?></label></td>
                                <td style="padding: 0 0 10px;">
                                    <select id="timeline_maptype">
                                        <option value="toner">Stamen Maps: Toner</option>
                                        <option value="toner-lines">Stamen Maps: Toner Lines</option>
                                        <option value="toner-labels">Stamen Maps: Toner Labels</option>
                                        <option value="watercolor">Stamen Maps: Watercolor</option>
                                        <option value="sterrain">Stamen Maps: Terrain</option>
                                        <option value="osm">OpenStreetMap</option>
                                        <option value="SATELLITE">Google Maps: Satellite</option>
                                        <option value="ROADMAP">Google Maps: Roadmap</option>
                                        <option value="TERRAIN">Google Maps: Terrain</option>
                                        <option value="HYBRID">Google Maps: Hybrid</option>
                                    </select><br/>
                                    <small><a href="http://maps.stamen.com/" target="_blank"><?php _e('Learn more about the map styles', 'kl-timeline'); ?></a></small></td>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_lang"><?php _e('Language', 'kl-timeline'); ?></label></td>
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
                                        <option value="zh-cn">Chinese</option>
                                        <option value="hr">Croatian / Hrvatski</option>
                                        <option value="cz">Czech</option>
                                        <option value="da">Danish</option>
                                        <option value="nl">Dutch</option>
                                        <option value="eo">Esperanto</option>
                                        <option value="et">Estonian</option>
                                        <option value="fo">Faroese</option>
                                        <option value="fa">Farsi</option>
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
                                        <option value="lt">Lithuanian</option>
                                        <option value="lb">Luxembourgish</option>
                                        <option value="ms">Malay</option>
                                        <option value="ne">Nepali</option>
                                        <option value="no">Norwegian</option>
                                        <option value="pl">Polish</option>
                                        <option value="pt">Portuguese</option>
                                        <option value="pt-br">Portuguese (Brazilian)</option>
                                        <option value="ro">Romanian</option>
                                        <option value="rm">Romansh</option>
                                        <option value="ru">Russian</option>
                                        <option value="sr-cy">Serbian - Cyrillic</option>
                                        <option value="sr">Serbian - Latin</option>
                                        <option value="si">Sinhalese</option>
                                        <option value="sk">Slovak</option>
                                        <option value="sl">Slovenian</option>
                                        <option value="es">Spanish</option>
                                        <option value="sv">Swedish</option>
                                        <option value="tl">Tagalog</option>
                                        <option value="ta">Tamil</option>
                                        <option value="zh-tw">Taiwanese</option>
                                        <option value="te">Telugu</option>
                                        <option value="th">Thai</option>
                                        <option value="tr">Turkish</option>
                                        <option value="uk">Ukrainian</option>
                                    </select><br/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="padding:15px;">
                    <input type="button" class="button-primary" value="<?php _e('Insert Timeline', 'kl-timeline'); ?>" onclick="insertTimeline();"/>
                    <a class="button" style="color:#bbb;" href="#" onclick="tb_remove(); return false;"><?php _e('Cancel', 'kl-timeline'); ?></a>
                </div>
            </div>
        </div>
    </div>

    <?php
}
