<?php
/**
 * Page Template
 * Description: Displays all pages by default.
 *
 * @package WordPress
 * @subpackage Wanderlust
 */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="container">
	<article>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</article>
</section><?php

endwhile; endif;
get_footer();