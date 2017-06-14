<?php
/**
 * @var array $classes
 */

?>
<div class="ow-hello-world-base ow-hello-world-align-<?php echo esc_attr($instance['design']['align']) ?>">

	<?php
	$hello_world_attributes = array(
		'class' => esc_attr( implode(' ', $classes) )
	);
	if(!empty($instance['attributes']['id'])) $hello_world_attributes['id'] = esc_attr($instance['attributes']['id']);
	if(!empty($instance['attributes']['title'])) $hello_world_attributes['title'] = esc_attr($instance['attributes']['title']);
	?>
	<p class="hello-world" <?php foreach($hello_world_attributes as $name => $val) echo $name . '="' . $val . '" ' ?>>
		<?php echo wp_kses_post($instance['text']); ?>
	</p>
	<p class="hello-world-desc <?php foreach($hello_world_attributes as $name => $val) echo $name . '=' . $val . '" ' ?>">
		
		<?php echo $instance['settings']['description']; ?>
	</p>
	<input type="hidden" name="storage_hash" value="<?php echo esc_attr($storage_hash) ?>" />

	<?php
	$post_selector_pseudo_query = $instance['some_posts'];
	// Process the post selector pseudo query.
	$processed_query = siteorigin_widget_post_selector_process_query( $post_selector_pseudo_query );

	// Use the processed post selector query to find posts.
	$query_result = new WP_Query( $processed_query );

	// Loop through the posts and do something with them.
	if($query_result->have_posts()) : ?>
	<div>
	    <ul>
	        <?php while($query_result->have_posts()) : $query_result->the_post(); ?>
	            <li>
	                <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
	                <div>
	                    <?php if( has_post_thumbnail() ) : $img = wp_get_attachment_image_src( get_post_thumbnail_id() ); ?>
	                        <a href="<?php the_permalink() ?>" style="background-image: url(<?php echo sow_esc_url($img[0]) ?>)"/>
	                    <?php endif; ?>
	                </div>
	            </li>
	        <?php endwhile; wp_reset_postdata(); ?>
	    </ul>
	</div>

	<?php endif; ?>

</div>
