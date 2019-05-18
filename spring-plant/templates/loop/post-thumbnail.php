<?php
/**
 * The template for displaying post-thumbnail-simple.php
 * @var $post_id
 * @var $image_size
 * @var $placeholder_enable
 * @var $first_image_enable,
 * @var $display_permalink
 * @var $mode
 * @var $image_mode
 * @var $image_ratio
 * @var $post_layout
 */
global $hasThumb;
$hasThumb = false;
ob_start();
remove_action('spring_plant_before_post_image',array(Spring_Plant()->templates(),'zoom_image_thumbnail'));
?>
    <?php if (has_post_thumbnail($post_id)): ?>
        <?php $hasThumb = true; ?>
        <?php if ($image_size === 'blog-large') $image_size = 'full'; ?>
        <?php Spring_Plant()->blog()->render_post_image_markup(array(
            'post_id' => $post_id,
            'image_id' => get_post_thumbnail_id($post_id),
            'image_size' => $image_size,
            'display_permalink' => $display_permalink,
            'image_mode' => $image_mode,
            'image_ratio' => $image_ratio
        )); ?>
    <?php elseif ($first_image_enable === true): ?>
        <?php
        global $post;
        if ( isset( $post->post_content ) ) {
            if ( preg_match( "'<\s*img\s.*?src\s*=\s*
                            ([\"\'])?
                            (?(1) (.*?)\\1 | ([^\s\>]+))'isx", $post->post_content, $matched ) ) {
                $img_src = esc_url( $matched[2] );
                $img_src = preg_replace('/-(\d+)x(\d+)\./i', '.', $img_src);
                if(function_exists('GSF')) {
                    $hasThumb = true;
                    $img_id = GSF()->helper()->getAttachmentIdByUrl($img_src);;
                    Spring_Plant()->blog()->render_post_image_markup(array(
                        'post_id' => $post_id,
                        'image_id' => $img_id,
                        'image_size' => $image_size,
                        'display_permalink' => $display_permalink,
                        'image_mode' => $image_mode,
                        'image_ratio' => $image_ratio
                    ));
                }
            }
        }
        ?>
    <?php endif; ?>
    <?php if (!$hasThumb && $placeholder_enable === true): ?>
        <?php $hasThumb = true; ?>
    <?php
    $post_type = get_post_type($post_id);
    $default_thumbnail_image = Spring_Plant()->options()->get_default_thumbnail_image();
    if(!empty($default_thumbnail_image) && isset($default_thumbnail_image['id']) && 'post' === $post_type ) {
        Spring_Plant()->blog()->render_post_image_markup(array(
            'post_id' => $post_id,
            'image_id' => $default_thumbnail_image['id'],
            'image_size' => $image_size,
            'display_permalink' => $display_permalink,
            'image_mode' => $image_mode,
            'image_ratio' => $image_ratio
        ));
    } else { ?>
        <div class="entry-thumbnail">
            <div class="entry-thumbnail-overlay thumbnail-size-<?php echo esc_attr($image_size); ?>  thumbnail-size-<?php echo esc_attr($image_ratio) ?> placeholder-image">
            </div>
        </div>
    <?php } ?>
    <?php endif; ?>
    <?php $thumbnail_markup = ob_get_clean(); ?>
    <?php if ($hasThumb === true): ?>
        <?php
        $wrapper_classes = array(
            'entry-thumb-wrap',
            "entry-thumb-mode-{$image_mode}",
            "entry-thumb-format-" . get_post_format()
        );
        $wrapper_class = implode(' ', $wrapper_classes);
        ?>
        <div class="<?php echo esc_attr($wrapper_class); ?>">
            <?php echo($thumbnail_markup); ?>
            <?php
            do_action('spring_plant_after_post_thumbnail', array('image_size' => $image_size))
            ?>
        </div>
    <?php endif;
add_action('spring_plant_before_post_image',array(Spring_Plant()->templates(),'zoom_image_thumbnail'));