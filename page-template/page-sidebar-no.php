<?php
/**
 * No Sidebar Page Template.
 *
 * Template Name: No Sidebar Page
 *
 * @package Dokanee
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php dokanee_content_class();?>>
		<main id="main" <?php dokanee_main_class(); ?>>
			<?php
			/**
			 * dokanee_before_main_content hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'dokanee_before_main_content' );

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) : ?>

					<div class="comments-area">
						<?php comments_template(); ?>
					</div>

				<?php endif;

			endwhile;

			/**
			 * dokanee_after_main_content hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'dokanee_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * dokanee_after_primary_content_area hook.
	 *
	 * @since 1.0.0
	 */
	 do_action( 'dokanee_after_primary_content_area' );

get_footer();
