<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 08/08/2017
 * Time: 5:00 CH
 */
$sidebar_layout = Spring_Plant()->options()->get_sidebar_layout();
$col_left_class = 'col-md-6 md-mg-bottom-30';
$col_right_class = 'col-md-6';
if($sidebar_layout === 'none') {
    $col_left_class = 'col-md-6 md-mg-bottom-30';
    $col_right_class = 'col-md-6';
}
?>
<div class="single-product-info single-style-01">
    <div class="single-product-info-inner row clearfix">
        <div class="<?php echo esc_attr($col_left_class); ?>">
			<div class="single-product-image">
				<div class="product-flash-inner">
					<?php
					remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
					do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>
				<?php
				remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_loop_sale_flash', 10);
				add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
				/**
				 * woocommerce_before_single_product_summary hook.
				 *
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
        </div>
        <div class="<?php echo esc_attr($col_right_class); ?>">
            <div class="summary-product entry-summary">
                <?php
                $product_add_to_cart_enable = Spring_Plant()->options()->get_product_add_to_cart_enable();
                if (!$product_add_to_cart_enable) {
                    remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
                }
                ?>

                <?php
                /**
                 * woocommerce_single_product_summary hook.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked shop_loop_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked shop_single_loop_sale_count_down - 15
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked shop_single_function - 60
                 */
                do_action( 'woocommerce_single_product_summary' );
                ?>

            </div><!-- .summary -->
        </div>
    </div>
</div>
