<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="grid-row">
	<div class="column-one-third">
		<h3 class="heading-medium">Advice content</h3>
		<ul class="pagenav">
			<?php	wp_list_pages(array('child_of' => get_page_by_title('advice')->ID, 'title_li' => null)); ?>
		</ul>
		<?php get_sidebar(); ?>
	</div>
	<div id="primary" class="content-area column-two-thirds">

		<main id="main" class="site-main" role="main">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// End of the loop.
			endwhile;
			?>

		</main><!-- .site-main -->
		<?php get_sidebar( 'content-bottom' ); ?>

	</div><!-- .content-area -->
</div>
<?php get_footer(); ?>
