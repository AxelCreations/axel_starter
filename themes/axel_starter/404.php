<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Axel_Starter_Theme
 */

get_header();
?>

<main id="page-404">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="error-template">
					<!-- Error Code and Message -->
					<h1 class="error-code">404</h1>
					<h2 class="error-message">Page Not Found</h2>
					<!-- Action Button -->
					<div class="error-actions">
						<a href="/" class="btn btn-primary">Go to Homepage</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php

get_footer();
