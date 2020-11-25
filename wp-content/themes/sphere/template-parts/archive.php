<?php
/**
 * The template for displaying archive pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<main id="main" class="site-main container" role="main">

	<header class="page-header mt-5">
		<h1 class="entry-title"><?php the_archive_title(); ?></h1>
	</header>
	<hr>
	<div class="page-content py-5">
		<?php
		while ( have_posts() ) : the_post();
			echo "<h2>".get_the_title()."</h2>";
			the_post_thumbnail();
			the_excerpt();
		endwhile;
		while ( have_posts() ) : the_post();
			echo "<h2>".get_the_title()."</h2>";
			the_post_thumbnail();
			the_excerpt();
		endwhile;
		while ( have_posts() ) : the_post();
			echo "<h2>".get_the_title()."</h2>";
			the_post_thumbnail();
			the_excerpt();
		endwhile;
		while ( have_posts() ) : the_post();
			echo "<h2>".get_the_title()."</h2>";
			the_post_thumbnail();
			the_excerpt();
		endwhile;
		while ( have_posts() ) : the_post();
			echo "<h2>".get_the_title()."</h2>";
			the_post_thumbnail();
			the_excerpt();
		endwhile;


		?>
	</div>
	
	<div class="entry-links"><?php wp_link_pages(); ?></div>

	<?php global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-below" class="navigation" role="navigation">
			<div class="nav-previous"><?php next_posts_link( sprintf( __( '%s older', 'elementor-hello-theme' ), '<span class="meta-nav">&larr;</span>' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( sprintf( __( 'newer %s', 'elementor-hello-theme' ), '<span class="meta-nav">&rarr;</span>' ) ); ?></div>
		</nav>
	<?php endif; ?>
</main>
