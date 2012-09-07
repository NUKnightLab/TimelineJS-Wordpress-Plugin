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
define( 'VERITETIMELINE_DIR', plugin_dir_path(__FILE__) );
define( 'VERITETIMELINE_SLUG', 'timeline');


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
        $ajax = admin_url( 'admin-ajax.php?action=timeline&type=json', 'relative' );
	extract(shortcode_atts(
		array(
            'title' => '',
            'width' => '100%',
            'height' => 650,
            'font' => '',
            'maptype' => 'toner',
            'lang' => 'en',
            'src'=> $ajax,
            'start_at_end' => 'false',
            'hash_bookmark' => 'false',
            'debug' => 'false',
            'start_at_slide' => null,
            'start_zoom_adjust' => null,
		), $atts
	));

	if ( $src == '' || $src == " ")
		$src = $ajax;

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
global $pagenow;
if($pagenow == 'post.php' || $pagenow == 'page.php' || $pagenow == 'page-new.php' || $pagenow == 'post-new.php') {
	add_action('admin_footer', 'verite_timeline_tinymce');
}

function verite_timeline_tinymce_button($context){
	global $pagenow;
    $is_post_edit_page = in_array($pagenow, array('post.php', 'page.php', 'page-new.php', 'post-new.php'));
    if(!$is_post_edit_page)
        return $context;

    $image_btn = VERITETIMELINE_URL . "/button-tinymce.png";
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

/* *********************** */

/**
 * Register our custom post type.
 */
add_action( 'init', 'timeline_init' );
function timeline_init()  {
	$labels = array(
		'name'               => __('Timeline', 'verite-timeline'),
		'singular_name'      => __('Timeline Entry', 'verite-timeline'),
		'add_new'            => __('Add Entry', 'verite-timeline'),
		'add_new_item'       => __('Add Entry', 'verite-timeline'),
		'edit_item'          => __('Edit Entry', 'verite-timeline'),
		'new_item'           => __('New Entry', 'verite-timeline'),
		'view_item'          => __('View Entry', 'verite-timeline'),
		'search_items'       => __('Search Entries', 'verite-timeline'),
		'not_found'          => __('No entries found', 'verite-timeline'),
		'not_found_in_trash' => __('No entries found in Trash', 'verite-timeline'),
		'parent_item_colon'  =>  '',
		'menu_name'          => __('Timeline', 'verite-timeline'),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true, 
		'show_in_menu'       => true, 
		'query_var'          => false,
		'capability_type'    => 'post',
		'has_archive'        => 'timeline', 
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title' ),
		'menu_position'      => 24,
	);

	register_post_type( 'timeline', $args );
}

// Add the CSS and JS for the metabox.
add_action( 'add_meta_boxes', 'timeline_metabox_init' );
function timeline_metabox_init() {
		wp_register_style( 'timeline-metaboxcss', VERITETIMELINE_URL . '/metabox/MetaBox.css' );
		wp_register_style( 'timeline-datepickercss', VERITETIMELINE_URL . '/metabox/jquery-ui-datepicker.css' );
		wp_register_script( 'timeline-metaboxjs', VERITETIMELINE_URL . '/metabox/MetaBox.js', array( 'jquery', 'jquery-ui-datepicker' ), null, true);
		wp_enqueue_style( 'timeline-metaboxcss' );
		wp_enqueue_style( 'timeline-datepickercss' );
		wp_enqueue_script( 'timeline-metaboxjs' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
}

/**
 * Create the metabox for timeline using WP Alchemy.
 */

// We do class_exists in case another plugin uses wpalchemy
if ( ! class_exists( 'WPAlchemy_MetaBox' ) )
include_once VERITETIMELINE_DIR . '/metabox/MetaBox.php';
if ( ! class_exists( 'WPAlchemy_MediaAccess' ) )
include_once VERITETIMELINE_DIR . '/metabox/MediaAccess.php';
// Define a Media Access Object
$wpalchemy_media_access = new WPAlchemy_MediaAccess();

$timeline_mb = new WPAlchemy_Metabox( array(
	'id' => '_timeline_mb',
	'title' => __( 'Timeline', 'verite-timeline' ),
	'types' => array( 'timeline' ),
	'autosave' => FALSE,
	'template' => VERITETIMELINE_DIR . '/metabox/metabox-timeline.php'
));

// Update the transient on save post.
add_action( 'save_post', 'timeline_update_transient' );
function timeline_update_transient( $post_id ) {
	$slug = VERITETIMELINE_SLUG;

	// Check if we're in the right cpt and have permissions.
	if ( $slug != $_POST['post_type'] ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

    // Passes our checks, so let's refresh the transient.
    $timeline = timeline_json();
    set_transient( 'verite-timeline' , $timeline, 60 * 60 * 24 * 30 );
}

/**
 * Querys the custom post type to obtain all necessary values to feed
 * timeline.js. If a post is selected as the intro slide, it will assign
 * that. Used to populate the 'verite-timeline' transient.
 * 
 * @return array Timeline values ready to be JSON encoded.
 */
function timeline_json() {
	global $timeline_mb;
        /* timeline does not handle smart quotes, etc. well */
        remove_filter('the_title', 'wptexturize');
        remove_filter('the_content', 'wptexturize');
	
	$timeline_args = array( 
		'post_type' => 'timeline'
	);

	$timeline_query = new WP_Query( $timeline_args ); 
        $dates = array();

	if ( $timeline_query->have_posts() ) : 
		while ( $timeline_query->have_posts() ) : 
			$timeline_query->the_post();
			$new_item = $timeline_mb->the_meta();
			$new_item['headline'] = get_the_title();
			$new_item['asset'] = array(
				'media' => $new_item['media'],
				'thumbnail' => $new_item['thumbnail'],
				'credit' => $new_item['credit'],
				'caption' => $new_item['caption'],
			);
			unset( $new_item['media'] );
			unset( $new_item['thumbnail'] );
			unset( $new_item['credit'] );
			unset( $new_item['caption'] );

			// If it's selected as the intro, set it as such
			if ( $new_item['intro'] == 'true' ) {
                                unset($new_item['intro']);
				$timeline['timeline'] = $new_item;
			} else {
                                unset($new_item['intro']);
                                array_push($dates, $new_item);
			}
		endwhile;
	endif;
	
	$timeline['timeline']['type'] = "default";
	$timeline['timeline']['date'] = $dates;
	wp_reset_postdata();
	return $timeline;
}

/**
 * Handles the ajax request for grabbing the timeline.
 */
add_action( 'wp_ajax_timeline', 'timeline_ajax' );
add_action( 'wp_ajax_nopriv_timeline', 'timeline_ajax' );
function timeline_ajax() {
	header('Content-Type: application/json');
	// If we have the transient, serve that instead.
	if ( $transient = get_transient('verite-timeline') )
		die( json_encode( $transient ) );

	// Otherwise we'll generate it.
	$timeline = timeline_json();
	die( json_encode( $timeline ) );
}

