<?php
/**
 * The template for displaying header-1.php
 *
 * @package WordPress
 * @subpackage spring
 * @since spring 1.0
 * @var $header_border
 * @var $header_sticky
 */

$header_classes = array(
	'mobile-header-wrap'
);

$header_inner_classes = array(
	'mobile-header-inner',
	'd-flex',
	'align-items-center'
);

if ($header_border === 'container') {
	$header_inner_classes[] = 'gf-border-bottom';
	$header_inner_classes[] = 'border-color';
}

if ($header_border == 'full') {
	$header_classes[] = 'gf-border-bottom';
	$header_classes[] = 'border-color';
}

if ($header_sticky !== '') {
	$header_classes[] = 'header-sticky';
}

$header_class = implode(' ', array_filter($header_classes));
$header_inner_class = implode(' ', array_filter($header_inner_classes));
?>
<div class="<?php echo esc_attr($header_class) ?>">
	<div class="container">
		<div class="<?php echo esc_attr($header_inner_class) ?>">
			<?php Spring_Plant()->helper()->getTemplate('header/mobile/toggle-menu',array('canvas_position' => 'left')) ?>
			<?php Spring_Plant()->helper()->getTemplate('header/mobile/logo') ?>
			<?php Spring_Plant()->helper()->getTemplate('header/header-customize', array('customize_location' => 'mobile','canvas_position' => 'right')); ?>
		</div>
	</div>
</div>
