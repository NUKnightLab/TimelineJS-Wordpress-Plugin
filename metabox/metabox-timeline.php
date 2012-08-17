<?php
/**
 * The WPAlchemy MetaBox template.
 *
 * We get the media access variable for later use.
 *
 * We need to generate the JSON for this:
 *
 *                "startDate":"2012,1,26",
 *                "headline":"Sh*t Politicians Say",
 *                "text":"<div class="form-field">Sh*t Politicians Say landed just hours before Thursday night’s Republican presidential debate and stars actor Joe Leon. In true political fashion, his character rattles off common jargon heard from people running for office.</div><div class="form-field">Do these ring a bell? Moral fiber, family values, trust me, three-point plan, earmarks, tough question, children are our future, Washington outsider, jobs, my opponent — all sound familiar.</div>",
 *                "asset":
 *                {
 *                    "media":"http://youtu.be/u4XpeU9erbg",
 *                   "credit":"",
 *                    "caption":""
 *                }
 *
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
				<label>Start Date</label>
				<?php $mb->the_field( 'startDate' ); ?>
				<input name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" type="text" class="datepicker" />			
			</div>
			<div class="form-field w50 right">
				<label>End Date</label>
				<?php $mb->the_field( 'endDate' ); ?>
				<input name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" type="text" class="datepicker" />			
			</div>
			<div class="form-field w50 left">
				<label>Media</label>
				<?php $mb->the_field( 'media' ); ?>
				<?php $wpalchemy_media_access->setGroupName( 'n' . $mb->get_the_index() )->setInsertButtonLabel( 'Insert Media' ); ?>
				<?php echo $wpalchemy_media_access->getField( array( 'name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'class' => 'w50' ) ); ?>
				<?php echo $wpalchemy_media_access->getButton(); ?>
			</div>
			<div class="form-field w50 right">
				<label>Credit</label>
				<?php $mb->the_field( 'credit' ); ?>
				<input name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" type="text" />
			</div>
			<div class="form-field w50 right">
				<label>Caption</label>
				<?php $mb->the_field( 'caption' ); ?>
				<input name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" type="text" />
			</div>
		</fieldset>
	</div>
</div>