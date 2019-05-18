<?php
/**
 * The template for displaying Header 9
 *
 * @package WordPress
 * @subpackage spring
 * @since spring 1.0
 * @var $header_layout
 * @var $header_float_enable
 * @var $header_border
 * @var $header_content_full_width
 * @var $header_sticky
 * @var $navigation_skin
 * @var $page_menu
 */
?>
<div class="header-above">
	<?php Spring_Plant()->helper()->getTemplate('header/desktop/logo',array('header_layout' => $header_layout)); ?>
</div>
<nav class="primary-menu">
	<?php if (has_nav_menu('primary') || $page_menu): ?>
		<?php
		$arg_menu = array(
			'menu_id' => 'main-menu',
			'container' => '',
			'theme_location' => 'primary',
			'menu_class' => 'gf-menu-vertical clearfix'
		);
        if (!empty($page_menu)) {
            $arg_menu['menu'] = $page_menu;
        }
		wp_nav_menu($arg_menu);
		?>
	<?php endif; ?>
</nav>
<?php Spring_Plant()->helper()->getTemplate('header/header-customize', array('customize_location' => 'nav', 'canvas_position' => 'left')); ?>


