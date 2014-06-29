<?php
/**
 * Single Post Template
 * Description: Displays all single posts.
 *
 * @package WordPress
 * @subpackage Wanderlust
 */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
$gal = get_term_by( 'id', get_post_meta( get_the_ID(), 'project_gallery', true ), 'gallery' ); ?>

<section class="container">
	<?php wanderlust_breadcrumbs(); ?>
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
			$gal_items = get_posts( array(
				'posts_per_page' => -1,
				'gallery' => $gal->slug,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_type' => 'attachment'
			) ); ?>
			<div id="slideshow"><?php
				$num=0;
				foreach ($gal_items as $key => $item) : $num++; ?>
					<div class="slide" id="slide-<?php echo $num; ?>">
					 	<?php echo wp_get_attachment_image( $item->ID, 'slide-size', false, array('class'=>'img-responsive') ); ?>
					</div><?php
				endforeach; ?>
			</div><!-- showcase end -->
			<div id="slideshow-thumbs"><?php
				$num=0;
				foreach ($gal_items as $key => $item) : $num++; ?>
					<div class="thumb" id="thumb-<?php echo $num; ?>"><?php
						$classes = $num==1 ? 'active-thumb img-thumbnail img-responsive' : 'img-thumbnail img-responsive';
						echo wp_get_attachment_image( $item->ID, 'thumbnail', false, array('class'=>$classes) );
						// echo $item->post_title;
						// echo $item->post_excerpt; ?>
					</div><?php
				endforeach; ?>
			</div><!-- showcase-thumbs end -->
		</article>
	</div>
</section><?php

endwhile; endif;
get_footer();