<?php
/**
 * Front Page Template
 * Description: Displays...
 *
 * @package Wordpress
 * @subpackage Flatfolio
 */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>

<section class="jumbotron clearfix" style="background-image: url('<?php echo $image[0]; ?>');">
	<article class="col-md-6 col-md-offset-6 col-sm-7 col-sm-offset-5 col-xs-12"><?php
		the_content(); ?>
	</article>
</section><?php

endwhile; endif;
get_footer();