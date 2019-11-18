<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Dokanee
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// If the navigation is set in the sidebar, set variable to true.
$navigation_active = ( 'nav-right-sidebar' == dokanee_get_navigation_location() ) ? true : false;

// If the secondary navigation is set in the sidebar, set variable to true.
if ( function_exists( 'dokanee_secondary_nav_get_defaults' ) ) {
	$secondary_nav = wp_parse_args(
		get_option( 'dokanee_secondary_nav_settings', array() ),
		dokanee_secondary_nav_get_defaults()
	);

	if ( 'secondary-nav-right-sidebar' == $secondary_nav['secondary_nav_position_setting'] ) {
		$navigation_active = true;
	}
}
?>
<div id="right-sidebar" itemtype="https://schema.org/WPSideBar" itemscope="itemscope" <?php dokanee_right_sidebar_class(); ?>>
	<?php
	if ( function_exists( 'dokan_is_store_listing' ) && dokan_is_store_listing() ) {
		woocommerce_breadcrumb();
	}
	?>
	<div class="inside-right-sidebar">
		<?php
		/**
		 * dokanee_before_right_sidebar_content hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'dokanee_before_right_sidebar_content' );

		if ( is_page_template( 'page-template/store-list.php' ) ) :

			if ( ! dynamic_sidebar( 'store-list' ) ) :

				if ( false == $navigation_active ) : ?>

                    <aside id="archives" class="widget">
                        <h2 class="widget-title"><?php esc_html_e( 'Archives', 'dokanee' ); ?></h2>
                        <ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>
                    </aside>

				<?php endif;

			endif;

        elseif ( is_archive( 'product' ) ) :

			if ( ! dynamic_sidebar( 'shop' ) ) :

				if ( false == $navigation_active ) : ?>

                    <aside id="archives" class="widget">
                        <h2 class="widget-title"><?php esc_html_e( 'Archives', 'dokanee' ); ?></h2>
                        <ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>
                    </aside>

				<?php endif;

			endif;

        elseif ( class_exists( 'WooCommerce' ) && is_product() ) :

			if ( ! dynamic_sidebar( 'product' ) ) :

				if ( false == $navigation_active ) : ?>

                    <aside id="archives" class="widget">
                        <h2 class="widget-title"><?php esc_html_e( 'Archives', 'dokanee' ); ?></h2>
                        <ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>
                    </aside>

				<?php endif;

			endif;

		elseif ( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() ) :

			if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) :

                if ( ! dynamic_sidebar( 'sidebar-store' ) ) :
                    $args = array(
                        'before_widget' => '<aside class="widget inner-padding">',
                        'after_widget'  => '</aside>',
                        'before_title'  => '<h3 class="widget-title">',
                        'after_title'   => '</h3>',
                    );

                    if ( class_exists( 'Dokan_Store_Location' ) ) :
                        the_widget( 'Dokan_Store_Category_Menu', array( 'title' => __( 'Store Category', 'dokanee' ) ), $args );

                        if ( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on' && ! empty( $map_location ) ) {
                            the_widget( 'Dokan_Store_Location', array( 'title' => __( 'Store Location', 'dokanee' ) ), $args );
                        }

                        if ( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
                            the_widget( 'Dokan_Store_Contact_Form', array( 'title' => __( 'Contact Vendor', 'dokanee' ) ), $args );
                        }
                    endif;

                endif;

			else :

                if ( ! dynamic_sidebar( 'sidebar-store' ) ) :

                $args = array(
                    'before_widget' => '<aside class="widget inner-padding">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h3 class="widget-title">',
                    'after_title'   => '</h3>',
                );

                if ( false == $navigation_active ) : ?>

                    <?php

                    if ( class_exists( 'Dokan_Store_Location' ) ) {
                        the_widget( 'Dokan_Store_Category_Menu', array( 'title' => __( 'Store Category', 'dokanee' ) ), $args );

                        if ( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on' && ! empty( $map_location ) ) {
                            the_widget( 'Dokan_Store_Location', array( 'title' => __( 'Store Location', 'dokanee' ) ), $args );
                        }

                        if ( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
                            the_widget( 'Dokan_Store_Contact_Form', array( 'title' => __( 'Contact Vendor', 'dokanee' ) ), $args );
                        }
                    }

                    ?>

                <?php endif;

            endif;

			endif;

		else :
			if ( ! dynamic_sidebar( 'sidebar-1' ) ) :

				if ( false == $navigation_active ) : ?>

                    <aside id="search" class="widget widget_search">
						<?php get_search_form(); ?>
                    </aside>

                    <aside id="archives" class="widget">
                        <h2 class="widget-title"><?php esc_html_e( 'Archives', 'dokanee' ); ?></h2>
                        <ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>
                    </aside>

				<?php endif;

			endif;
		endif;


		/**
		 * dokanee_after_right_sidebar_content hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'dokanee_after_right_sidebar_content' );
		?>
	</div><!-- .inside-right-sidebar -->
</div><!-- #secondary -->
