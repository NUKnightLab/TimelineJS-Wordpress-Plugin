<?php

add_action( 'add_meta_boxes', 'timeline_metabox_init' );

function timeline_metabox_init() {
		wp_register_style(  'metabox', VERITETIMELINE_URL . '/wpalchemy/MetaBox.css' );
		wp_enqueue_style( 'metabox' );
}

// We do class_exists in case another plugin has wpalchemy
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
	'title' => 'Timeline Extras',
	'types' => array( 'timeline' ),
	'template' => VERITETIMELINE_DIR . '/wpalchemy/metabox-timeline.php'
));