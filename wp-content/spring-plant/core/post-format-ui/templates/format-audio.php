<?php
/**
 * The template for displaying format-audio.php
 */
global $post;
?>
<div class="gf-form-group">
	<label for="<?php echo esc_attr(Spring_Plant_Post_Formats_UI()->get_format_audio_embed()) ?>"><?php esc_html_e('Audio URL (oEmbed) or Embed Code','spring-plant'); ?></label>
	<textarea rows="5" placeholder="<?php esc_attr_e('Audio URL (oEmbed) or Embed Code','spring-plant'); ?>" class="gf-form-control" name="<?php echo esc_attr(Spring_Plant_Post_Formats_UI()->get_format_audio_embed()) ?>" id="<?php echo esc_attr(Spring_Plant_Post_Formats_UI()->get_format_audio_embed()) ?>" tabindex="1"><?php echo esc_textarea(get_post_meta($post->ID, Spring_Plant_Post_Formats_UI()->get_format_audio_embed(), true)); ?></textarea>
</div>
