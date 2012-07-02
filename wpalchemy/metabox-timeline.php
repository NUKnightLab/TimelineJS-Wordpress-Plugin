<?php
/**
 * The WPAlchemy MetaBox template.
 *
 * We get the media access variable for later use.
 */
global $wpalchemy_media_access;
?>

<div id="timeline-wrap" class="timeline-metabox">
	<div class="content">
		<?php $mb->the_field( 'first_heading' ); ?>
				<input name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value();?>" />