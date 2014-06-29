<?php
/**
 * Category Template
 * Description: Displays queued category query.
 *
 * @package Wordpress
 * @subpackage Wanderlust
 */
get_header(); ?>

<section class="container">
	<?php wanderlust_breadcrumbs(); ?>
</section>
<section class="container">
	<div class="row"><?php
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="col-md-3 col-sm-4 col-xs-6">
				<a href="<?php the_permalink(); ?>">
					<div class="thumbnail">
						<div class="caption">
							<h2><?php the_title(); ?></h2>
						</div><?php
						the_post_thumbnail( 'preview-size' ); ?>
					</div>
				</a>
			</article><?php
		endwhile; endif; ?>
	</div><!-- /.row -->
</section><!-- /.container -->

<?php get_footer();