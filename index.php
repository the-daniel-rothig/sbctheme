<?php
/**
 * The main template file
 *
 * @package SBC
 * @subpackage SBCTheme
 * @since SBC Theme 1.0
 */

get_header(); ?>

<?php if (is_front_page()) : ?>
	<main id="main" class="site-main" role="main">
    <?php echo apply_filters('the_content', get_page_by_title('home')->post_content); ?>
	</main><!-- .site-main -->	
<?php endif; ?>


<div class="grid-row">
	<div id="primary" class="column-two-thirds content-area">
		
		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="heading-xlarge page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</div><!-- .content-area -->

	<div class="column-one-third">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
