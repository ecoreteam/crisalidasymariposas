<?php
/**
 * The template for displaying page-title
 */
global $breadcrumb_used;
$breadcrumb_used = false;
$page_title_enable = Spring_Plant()->options()->get_page_title_enable();
if ($page_title_enable !== 'on') return;
$content_block = Spring_Plant()->options()->get_page_title_content_block();
$skin = Spring_Plant()->options()->get_page_title_skin();

$wrapper_classes = array(
	'gf-page-title'
);

if(empty($content_block)) {
    $wrapper_classes[] = 'gf-page-title-default';
}

$skin_classes = Spring_Plant()->helper()->getSkinClass($skin);
$wrapper_classes = array_merge($wrapper_classes, $skin_classes);
$wrapper_class = implode(' ', array_filter($wrapper_classes));
?>
<div class="<?php echo esc_attr($wrapper_class) ?>">
	<?php if (!empty($content_block)): ?>
		<?php echo Spring_Plant()->helper()->content_block($content_block); ?>
	<?php else: ?>
		<?php $page_title = Spring_Plant()->helper()->get_page_title(); ?>
        <?php $breadcrumb_used = true; ?>
		<div class="container">
			<div class="page-title-inner row no-gutters align-items-center">
				<h1><?php echo esc_html($page_title); ?></h1>
				<?php Spring_Plant()->breadcrumbs()->get_breadcrumbs(); ?>
			</div>
		</div>
	<?php endif; ?>
</div>
