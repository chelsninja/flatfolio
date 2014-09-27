<?php
/**
 * Single Post Template
 * Description: Displays all single posts.
 *
 * @package WordPress
 * @subpackage Flatfolio
 */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
$gal = get_term_by( 'id', get_post_meta( get_the_ID(), 'project_gallery', true ), 'gallery' ); ?>

<section class="container"><?php
	ff_breadcrumbs(); ?>
</section>
<section class="container">
	<div class="row">
		<aside class="col-md-4">
			<h2><?php the_title(); ?></h2><?php
			the_excerpt(); ?>
			<h3>Project Details</h3><?php
			the_content();
			if ( get_the_tag_list() ) : ?>
				<h3>Skills Involved</h3><?php
			   echo get_the_tag_list('<ul><li>','</li><li>','</li></ul>');
			endif; ?>
			<ul class="pager">
				<li class="previous"><?php previous_post_link('%link', '&larr; %title' , TRUE, '1'); ?></li>
				<li class="next"><?php next_post_link('%link', '%title &rarr;', TRUE, '1'); ?></li>
			</ul>
		</aside>
		<article class="col-md-8"><?php 
			ff_gallery($gal); ?>
		</article>
	</div>
</section><?php

endwhile; endif;
get_footer();