<?php
/**
 * The WPAlchemy MetaBox template
 */
global $wpalchemy_media_access;
?>

<div id="timeline-wrap" class="timeline-metabox form-wrap">
	<div class="content">
		<fieldset>
			<?php 
				$mb->the_field( 'text' ); 
				wp_editor( html_entity_decode( $mb->get_the_value() ), 'timeline-entry-editor', 
					array( 'textarea_name' => $mb->get_the_name(), 'textarea_rows' => 10 )
				);
			?>
			<div class="form-field w50 left">
				<label><?php _e('Start Date', 'verite-timeline'); ?></label>
				<?php $mb->the_field( 'startDate' ); ?>
				<input name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" type="text" class="datepicker" />			
			</div>
			<div class="form-field w50 right">
				<label><?php _e('End Date', 'verite-timeline'); ?></label>
				<?php $mb->the_field( 'endDate' ); ?>
				<input name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" type="text" class="datepicker" />			
			</div>
			<div class="form-field w50 left">
				<label><?php _e('Media', 'verite-timeline'); ?></label>
				<?php $mb->the_field( 'media' ); ?>
				<?php $wpalchemy_media_access->setGroupName( 'n' . $mb->get_the_index() )->setInsertButtonLabel( 'Insert Media' ); ?>
				<?php echo $wpalchemy_media_access->getField( array( 'name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'class' => 'w50' ) ); ?>
				<?php echo $wpalchemy_media_access->getButton(); ?>
			</div>
			<div class="form-field w50 right">
				<label><?php _e('Credit', 'verite-timeline'); ?></label>
				<?php $mb->the_field( 'credit' ); ?>
				<input name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" type="text" />
			</div>
			<div class="form-field w50 right">
				<label><?php _e('Caption', 'verite-timeline'); ?></label>
				<?php $mb->the_field( 'caption' ); ?>
				<input name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" type="text" />
			</div>
			<div class="form-field w50">
				<?php $mb->the_field( 'intro' ); ?>
				<label><?php _e('Use as intro slide?', 'verite-timeline'); ?></label>
				<input type="radio" name="<?php $mb->the_name(); ?>" value="true"<?php echo $mb->is_value('true')?' checked="checked"':''; ?>/> <?php _e('Yes', 'verite-timeline'); ?>
				<input type="radio" name="<?php $mb->the_name(); ?>" value="false"<?php echo $mb->is_value('false')?' checked="checked"':''; ?>/> <?php _e('No', 'verite-timeline'); ?>
			</div>
			<div class="form-field w50 left">
				<label><?php _e('Thumbnail', 'verite-timeline'); ?></label>
				<?php $mb->the_field( 'thumbnail' ); ?>
				<?php $wpalchemy_media_access->setGroupName( 'n' . $mb->get_the_index() )->setInsertButtonLabel( 'Insert Media' ); ?>
				<?php echo $wpalchemy_media_access->getField( array( 'name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'class' => 'w50' ) ); ?>
				<?php echo $wpalchemy_media_access->getButton(); ?>
			</div>
		</fieldset>
	</div>
</div>
