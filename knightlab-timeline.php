<?php
/**
 * Knight Lab TimelineJS.
 *
 * @package knightlab/timeline
 */

/**
 * Plugin Name: Knight Lab TimelineJS
 * Plugin URI: http://timeline.knightlab.com/
 * Description: A simple shortcode to display TimelineJS.
 * Version: 3.9.3.1
 * Author: Knight Lab
 * Author URI: http://knightlab.northwestern.edu/
 * License: Mozilla Public License, v. 2.0
 */

/*
This Source Code Form is subject to the terms of the Mozilla Public
License, v. 2.0. If a copy of the MPL was not distributed with this
file, You can obtain one at http://mozilla.org/MPL/2.0/.
*/

define( 'KL_TIMELINE_URL', plugin_dir_url( __FILE__ ) );
define( 'KL_TIMELINE_VERSION', '3.8.22.0' );

wp_oembed_add_provider( '#https?://cdn.knightlab.com/libs/timeline3/.*#i', 'https://oembed.knightlab.com/timeline/' );

add_action( 'init', 'kl_timeline_scripts' );
/**
 * Ensure jQuery is loaded.
 */
function kl_timeline_scripts() {
	wp_enqueue_script( 'jquery' );
}

add_action( 'init', 'kl_timeline_textdomain' );
/**
 * Set the localization text domain.
 */
function kl_timeline_textdomain() {
	$plugin_dir = basename( dirname( __FILE__ ) );
	load_plugin_textdomain( 'kl-timeline', false, $plugin_dir . '/languages/' );
}

add_shortcode( 'timeline', 'kl_timeline_shortcode' );
/**
 * Handle the [timeline] shortcode.
 *
 * @param array $atts    Array of shortcode attributes.
 * @param int   $content  Shortcode content.
 * @return string
 */
function kl_timeline_shortcode( $atts, $content = null ) {
	extract(
		shortcode_atts(
			[
				'title'             => '',
				'width'             => '100%',
				'height'            => 650,
				'font'              => '',
				'lang'              => 'en',
				'src'               => '',
				'start_at_end'      => 'false',
				'hash_bookmark'     => 'false',
				'debug'             => 'false',
				'maptype'           => '',
				'start_at_slide'    => 0,
				'start_zoom_adjust' => null,
				'initial_zoom'      => 2,
				'version'           => '',
				'script_path'       => plugin_dir_url( __FILE__ ),
			],
			$atts
		)
	);

	if ( empty( $src ) ) {
		return false;
	}

	if ( empty( $width ) ) {
		$width = 0;
	}

	if ( empty( $height ) ) {
		$height = 0;
	}

	if ( 'timeline2' === $version ) {
		$script_path .= 'js/';
		wp_register_script( 'kl-timeline-embed', $script_path . 'storyjs-embed.js', [ 'jquery' ], KL_TIMELINE_VERSION, true );
	} else {
		$script_path .= 'v3/js/';
		wp_register_script( 'kl-timeline-embed', $script_path . 'timeline-embed.js', [ 'jquery' ], KL_TIMELINE_VERSION, true );
	}

	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		$js_path = $script_path . 'timeline.js';
	} else {
		$js_path = $script_path . 'timeline-min.js';
	}

	$css_path = plugin_dir_url( __FILE__ ) . 'css/timeline.css';


		wp_enqueue_script( 'kl-timeline-embed' );
		$shortcode = '
	<div id="timeline-embed"></div>
	<script type="text/javascript">// <![CDATA[
		var timeline_config = {
			width: "' . intval( $width ) . '",
			height: "' . intval( $height ) . '",
			source: "' . $src . '",
			embed_id: "timeline-embed",
			start_at_end: ' . $start_at_end . ',
			start_at_slide: "' . $start_at_slide . '",
			start_zoom_adjust: "' . $start_zoom_adjust . '",
			initial_zoom:"' . $initial_zoom . '",
			hash_bookmark: ' . $hash_bookmark . ',
			font: "' . $font . '",
			lang: "' . $lang . '",
			maptype: "' . $maptype . '",
			script_path: "' . $script_path . '"
		}
// ]]></script>
		';
		return $shortcode;
}

// TinyMCE.
add_action( 'media_buttons_context', 'kl_timeline_tinymce_button' );

// Add content for creating a timeline.
add_action( 'admin_footer', 'kl_timeline_tinymce' );

/**
 * TinyMCE Button for the shortcode
 *
 * @param string $context Media buttons context. Default empty.
 * @return string
 */
function kl_timeline_tinymce_button( $context ) {

	$img          = KL_TIMELINE_URL . 'knight-diamond.png';
	$container_id = 'add_timeline_form';
	$title        = __( 'Insert Timeline', 'kl-timeline' );

	// Append the icon.
	$context .= "<a class='thickbox button' style='background: url({$img}) no-repeat 3px 3px; padding-left: 20px' title='{$title}' id='add_timeline'
	href='#TB_inline?width=600&height=495&inlineId={$container_id}'> Add Timeline</a>";

	return $context;
}

/**
 * Print JavaScript for the timeline.
 */
function kl_timeline_tinymce() {
	?>
<script type="text/javascript">
		function insertTimeline(){
			var data_src = jQuery('#timeline_data_src').val();
			var height = jQuery('#timeline_height').val();
			var width = jQuery('#timeline_width').val();
			var lang = jQuery('#timeline_lang').val();
			var font = jQuery('#timeline_font').val();
			try {
				// doesn't exist in TJS3
				var maptype = jQuery('#timeline_maptype').val();
			} catch(e) {
				console.log(e);
			}

			window.send_to_editor("[timeline src=\"" + data_src + "\" width=\"" + width + "\" height=\"" + height + "\" font=\"" + font + "\" lang=\"" + lang + "\" version=\"timeline3\" ]");
		}
	</script>

	<div id="add_timeline_form" style="display:none;" class="thickbox" >
		<div class="wrap">
			<div>
				<div style="padding:15px 15px 0 15px;">
					<h3 style="color:#5A5A5A!important; font-family:Georgia,Times New Roman,Times,serif!important; font-size:1.8em!important; font-weight:normal!important;"><?php esc_html_e( 'Insert Timeline', 'kl-timeline' ); ?></h3>
					<span>
						<?php esc_html_e( 'Configure your Timeline and add it to your post', 'kl-timeline' ); ?>
					</span>
				</div>
				<div style="padding:15px 15px 0 15px;">
					<table>
						<tbody>
							<tr>
								<td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_data_src"><?php esc_html_e( 'Data source', 'kl-timeline' ); ?></label></td>
								<td style="padding: 0 0 10px;"><input type="text" id="timeline_data_src" size="75" style="width:450px;"/><br/>
									<small><a href="http://timeline.knightlab.com/" target="_blank"><?php esc_html_e( 'Learn how to create your timeline', 'kl-timeline' ); ?></a></small></td>
							</tr>
							<tr>
								<td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_width"><?php esc_html_e( 'Width', 'kl-timeline' ); ?></label></td>
								<td style="padding: 0 0 10px;"><input type="text" id="timeline_width" size="5" value="100%" /></td>
							</tr>
							<tr>
								<td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_height"><?php esc_html_e( 'Height', 'kl-timeline' ); ?></label></td>
								<td style="padding: 0 0 10px;"><input type="text" id="timeline_height" size="5" value="650" /></td>
							</tr>
							<tr>
								<td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_font"><?php esc_html_e( 'Fonts', 'kl-timeline' ); ?></label></td>
								<td style="padding: 0 0 10px;">
									<select id="timeline_font">
										<option value="Default">PT Narrow & PT Serif</option>
										<option value="Abril-DroidSans">Abril & Droid Sans</option>
										<option value="Amatic-Andika">Amatic & Andika</option>
										<option value="Bevan-PontanoSans">Bevan & Pontano Sans</option>
										<option value="Bitter-Raleway">Bitter and Raleway</option>
										<option value="Clicker-Garamond">Clicker and Garamond</option>
										<option value="Dancing-Ledger">Dancing and Ledger</option>
										<option value="Fjalla-Average">Fjalla and Average</option>
										<option value="Georgia-Helvetica">Georgia and Helvetica</option>
										<option value="Lustria-Lato">Lustria and Lato</option>
										<option value="Medula-Lato">Medula One and Lato</option>
										<option value="OldStandard">Old Standard</option>
										<option value="OpenSans-GentiumBook">Open Sans and Gentium Book</option>
										<option value="Playfair-FaunaOne">Playfair and Fauna One</option>
										<option value="Playfair">Playfair SC and Playfair</option>
										<option value="PT">PT Sans, PT Sans Narrow, and PT Serif</option>
										<option value="Roboto-Megrim">Rufina and Sintony</option>
										<option value="UnicaOne-Vollkorn">Unica One and Vollkorn</option>
									</select>
<br/>
								</td>
							</tr>
							<tr>
								<td valign="top" style="padding: 0 15px 5px 0;"><label for="timeline_lang"><?php esc_html_e( 'Language', 'kl-timeline' ); ?></label></td>
								<td style="padding: 0 0 10px;">
									<select id="timeline_lang">
									<option value="en" data-lang="English">English</option>
									<option value="en-24hr" data-lang="English (24-hour time)">English (24-hour time)</option>
									<option value="ar" data-lang="Arabic">العربية</option>
									<option value="af" data-lang="Afrikaans">Afrikaans</option>
									<option value="id" data-lang="Indonesian">Bahasa Indonesia</option>
									<option value="ms" data-lang="Malay">Bahasa Melayu</option>
									<option value="be" data-lang="Belarusian">Беларуская мова</option>
									<option value="bg" data-lang="Bulgarian">български език</option>
									<option value="ca" data-lang="Catalan">Català</option>
									<option value="cz" data-lang="Czech">Čeština</option>
									<option value="da" data-lang="Danish">Dansk</option>
									<option value="hi" data-lang="Hindi">हिन्दी</option>
									<option value="de" data-lang="German">Deutsch</option>
									<option value="et" data-lang="Estonian">Eesti keel</option>
									<option value="el" data-lang="Greek">ελληνικά</option>
									<option value="es" data-lang="Spanish">Español</option>
									<option value="eo" data-lang="Esperanto">Esperanto</option>
									<option value="eu" data-lang="Basque">Euskara</option>
									<option value="fo" data-lang="Faroese">Føroyskt</option>
									<option value="fr" data-lang="French">Français</option>
									<option value="fy" data-lang="Frisian">Frysk</option>
									<option value="ga" data-lang="Irish">Gaeilge</option>
									<option value="gl" data-lang="Galician">Galego</option>
									<option value="ko" data-lang="Korean">한국어</option>
									<option value="hr" data-lang="Croatian">Hrvatski</option>
									<option value="hy" data-lang="Armenian">Հայերէն</option>
									<option value="is" data-lang="Icelandic">Íslenska</option>
									<option value="it" data-lang="Italian">Italiano</option>
									<option value="he" data-lang="Hebrew">עברית</option>
									<option value="ka" data-lang="Georgian">ქართული</option>
									<option value="lv" data-lang="Latvian">Latviešu valoda</option>
									<option value="lb" data-lang="Luxembourgish">Lëtzebuergesch</option>
									<option value="lt" data-lang="Lithuanian">Lietuvių kalba</option>
									<option value="ro" data-lang="Romanian">Limba română</option>
									<option value="hu" data-lang="Hungarian">Magyar</option>
									<option value="my" data-lang="Myanmar"> မြန်မာ</option>
									<option value="nl" data-lang="Dutch">Nederlands</option>
									<option value="ne" data-lang="Nepali">नेपाली</option>
									<option value="ja" data-lang="Japanese">日本語</option>
									<option value="no" data-lang="Norwegian">Norsk</option>
									<option value="nb" data-lang="Norwegian - Bokmal">Norsk (bokmål)</option>
									<option value="nn" data-lang="Norwegian - Nynorsk">Norsk (nynorsk)</option>
									<option value="th" data-lang="Thai">ภาษาไทย</option>
									<option value="pl" data-lang="Polish">Polski</option>
									<option value="pt" data-lang="Portuguese">Português</option>
									<option value="pt-br" data-lang="Portuguese - Brazilian">Português (Brasil)</option>
									<option value="rm" data-lang="Romansh">Rumantsch</option>
									<option value="ru" data-lang="Russian">Русский язык</option>
									<option value="si" data-lang="Sinhalese">සිංහල</option>
									<option value="sl" data-lang="Slovenian">Slovenščina</option>
									<option value="sk" data-lang="Slovak">Slovenčina</option>
									<option value="sr" data-lang="Serbian - Latin">Srpski</option>
									<option value="sr-cy" data-lang="Serbian - Cyrillic">српски</option>
									<option value="fi" data-lang="Finnish">Suomi</option>
									<option value="sv" data-lang="Swedish">Svenska</option>
									<option value="zh-tw" data-lang="Taiwanese">Taiwanese</option>
									<option value="tl" data-lang="Tagalog">Tagalog</option>
									<option value="ta" data-lang="Tamil">தமிழ்</option>
									<option value="te" data-lang="Telugu">తెలుగు</option>
									<option value="tr" data-lang="Turkish">Türkçe</option>
									<option value="uk" data-lang="Ukrainian">Українська</option>
									<option value="ur" data-lang="Urdu">اُردُو</option>
									<option value="fa" data-lang="Farsi">فارسی</option>
									<option value="zh-cn" data-lang="Chinese">中文</option>
									</select><br/>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div style="padding:15px;">
					<input type="button" class="button-primary" value="<?php esc_attr_e( 'Insert Timeline', 'kl-timeline' ); ?>" onclick="insertTimeline();"/>
					<a class="button" style="color:#bbb;" href="#" onclick="tb_remove(); return false;"><?php esc_html_e( 'Cancel', 'kl-timeline' ); ?></a>
				</div>
			</div>
		</div>
	</div>

	<?php
}
