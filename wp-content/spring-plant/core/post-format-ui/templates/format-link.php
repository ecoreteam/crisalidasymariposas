<?php
/**
 * The template for displaying format-link
 */
global $post;
?>
<div class="gf-form-group">
	<label for="<?php echo esc_attr(Spring_Plant_Post_Formats_UI()->get_format_link_url()) ?>"><?php esc_html_e('Url','spring-plant'); ?></label>
	<input class="gf-form-control" type="text" placeholder="<?php esc_attr_e('Url','spring-plant'); ?>" name="<?php echo esc_attr(Spring_Plant_Post_Formats_UI()->get_format_link_url()) ?>" value="<?php echo esc_attr(get_post_meta($post->ID, Spring_Plant_Post_Formats_UI()->get_format_link_url(), true)); ?>" id="<?php echo esc_attr(Spring_Plant_Post_Formats_UI()->get_format_link_url()) ?>" tabindex="2" />
</div>
