<?php
/**
 * The template for displaying post-title.php
 *
 * @package WordPress
 * @subpackage spring
 * @since spring 1.0
 */
global $single_post_title;
if(!empty($single_post_title)) return;
?>
<h1 class="gf-post-title heading-color"><?php the_title() ?></h1>
