<?php /* Template Name: Form page */ 

$ticket_result = null;
$ticketstatus_result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$ticket_result = sbctheme_trycreateticket();
} else if (isset($_GET['ticket'])) {
	$ticketstatus_result = sbctheme_trygetticket();
}

get_header();?>

<div class="grid-row">
	<div id="primary" class="content-area column-two-thirds">
		<main id="main" class="site-main" role="main">
			<?php 
			if($ticketstatus_result !== null) {
				// if a ticket status has been requested, render a status page
				sbctheme_ticketstatus($ticketstatus_result);
			} else if ($ticket_result !== null && !$ticket_result['isError']) {
				// if a ticket has just been created successfully, render the success page
				sbctheme_ticketcreationsuccess($ticket_result);
			} else {
				// otherwise, render the contact form intro page, followed by the form
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				}
				if($ticket_result !== null && $ticket_result['isError']) { 
					echo '<div class="error-summary" role="group" aria-labelledby="error-summary-heading" tabindex="-1"><h1 class="heading-medium error-summary-heading" id="error-summary-heading">There is an issue with the information you provided</h1><p>';
					echo $ticket_result['errorMessage']; 
					echo '</p><p>Please correct your answers below.</p>';
				}
				get_template_part( 'template-parts/contactform');
			}?>
		</main><!-- .site-main -->
		<?php get_sidebar( 'content-bottom' ); ?>

	</div><!-- .content-area -->

	<div class="column-one-third">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
