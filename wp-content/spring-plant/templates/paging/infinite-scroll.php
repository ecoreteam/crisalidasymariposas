<?php
/**
 * The template for displaying infinite-scroll.php
 * @var $settingId
 */
$paged   =  Spring_Plant()->query()->query_var_paged();
$max_num_pages = Spring_Plant()->query()->get_max_num_pages();
$paged = intval($paged) + 1;
if ($paged > $max_num_pages) return;
?>
<div data-items-paging="infinite-scroll" class="gf-paging infinite-scroll clearfix text-center" data-id="<?php echo esc_attr($settingId) ?>">
	<a data-paged="<?php echo esc_attr($paged); ?>" class="no-animation transition03 gsf-link" href="#">
	</a>
</div>
