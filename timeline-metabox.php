<?php

add_action( 'add_meta_boxes', 'timeline_metabox_init' );

function timeline_metabox_init() {
		wp_register_style( 'timeline-metaboxcss', VERITETIMELINE_URL . '/wpalchemy/MetaBox.css' );
		wp_register_style( 'timeline-datepickercss', VERITETIMELINE_URL . '/wpalchemy/jquery-ui-datepicker.css' );
		wp_register_script( 'timeline-metaboxjs', VERITETIMELINE_URL . '/wpalchemy/MetaBox.js', array( 'jquery', 'jquery-ui-datepicker' ), null, true);
		wp_enqueue_style( 'timeline-metaboxcss' );
		wp_enqueue_style( 'timeline-datepickercss' );
		wp_enqueue_script( 'timeline-metaboxjs' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
}

// We do class_exists in case another plugin uses wpalchemy
if ( ! class_exists( 'WPAlchemy_MetaBox' ) )
include_once VERITETIMELINE_DIR . '/wpalchemy/MetaBox.php';

if ( ! class_exists( 'WPAlchemy_MediaAccess' ) )
include_once VERITETIMELINE_DIR . '/wpalchemy/MediaAccess.php';

// Define a Media Access Object
$wpalchemy_media_access = new WPAlchemy_MediaAccess();

/**
 * Create new metabox for our custom post type.
 */

$timeline_mb = new WPAlchemy_Metabox( array(
	'id' => '_timeline_mb',
	'title' => __( 'Timeline', 'verite-timeline' ),
	'types' => array( 'timeline' ),
	'template' => VERITETIMELINE_DIR . '/wpalchemy/metabox-timeline.php'
));