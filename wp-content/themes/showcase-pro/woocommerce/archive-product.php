<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

<div class="pricing-table">
	<div class="plan one-fifth first">
		<div class="top">
			<h4><a href="/product-category/puzzles/">Puzzles</a></h4>
			<ul>
		        <li><a href="/product-category/puzzles/"><img src="/wp-content/uploads/2016/08/Great-Mind-Puzzles-P001.jpg" alt="Puzzles" width="200" height="200"/></a></li>
			</ul>
		</div>
    </div>
    <div class="plan one-fifth">
		<div class="top">
			<h4><a href="/product-category/games/">Games</a></h4>
			<ul>
		        <li><a href="/product-category/games/"><img src="/wp-content/uploads/2016/08/Cathedral-Game-G011-200x139.jpg" alt="Puzzles" width="200" height="200"/></a></li>
			</ul>
		</div>
    </div>
    <div class="plan one-fifth">
		<div class="top">
			<h4><a href="/product-category/models-and-kits/">Models and Kits</a></h4>
			<ul>
		        <li><a href="/product-category/models-and-kits/"><img src="/wp-content/uploads/2016/08/Eiffel-Tower-Kit-MK007-200x198.jpg" alt="Puzzles" width="200" height="200"/></a></li>
			</ul>
		</div>
    </div>
    <div class="plan one-fifth">
		<div class="top">
			<h4><a href="/product-category/outdoor/">Outdoor</a></h4>
			<ul>
		        <li><a href="/product-category/outdoor/"><img src="/wp-content/uploads/2016/08/nightball-set-O-006-200x200.jpg" alt="Puzzles" width="200" height="200"/></a></li>
			</ul>
		</div>
    </div>
    <div class="plan one-fifth">
		<div class="top">
			<h4><a href="/product-category/jigsaw-puzzles/">Jigsaw Puzzles<br>(3D/4D)</a></h4>
			<ul>
		        <li><a href="/product-category/jigsaw-puzzles/"><img src="/wp-content/uploads/2016/08/3D-World-Trade-Center-J002-200x174.jpg" alt="Puzzles" width="200" height="200"/></a></li>
			</ul>
		</div>
    </div>
</div>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>


<?php get_footer( 'shop' ); ?>
