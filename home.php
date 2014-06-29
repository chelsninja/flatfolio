<?php
/**
 * Template Name: Portfolio Template
 * Description: Displays...
 *
 * @package Wordpress
 * @subpackage Wanderlust
 */
get_header();
$categories = get_categories( array( 'orderby' => 'id', 'exclude' => '1' ) ); ?>

<section id="portfolio" class="container">
	<div class="row"><?php
		foreach ( $categories as $cat ) :
			$layout = get_option( 'category_'.$cat->cat_ID, 'layout1' ); ?>
			<article class="<?php echo $cat->slug; ?> col-md-4 col-sm-6">
				<a href="<?php echo get_category_link( $cat->cat_ID ); ?>">
					<div class="thumbnail">
					<div class="caption">
						<h2><?php echo $cat->name; ?></h2>
					</div><?php
					$cat_query = new WP_Query( 'cat='.$cat->cat_ID.'&posts_per_page=3&orderby=menu_order&order=ASC' );
					$num=0;
					while ( $cat_query->have_posts() ) : $cat_query->the_post(); $num++;
						switch ( $layout ) :
							case 'layout2':
								if ( $num==1 ) :
									the_post_thumbnail( 'thumb-square' );
								elseif ( $num==2 ) :
									the_post_thumbnail( 'thumb-square' );
								else :
									the_post_thumbnail( 'thumb-wide' );
								endif;
							break;
							case 'layout3':
								if ( $num==1 ) :
									the_post_thumbnail( 'thumb-long' );
								elseif ( $num==2 ) :
									the_post_thumbnail( 'thumb-square' );
								else :
									the_post_thumbnail( 'thumb-square' );
								endif;
							break;
							case 'layout4':
								if ( $num==1 ) :
									the_post_thumbnail( 'thumb-wide' );
								elseif ( $num==2 ) :
									the_post_thumbnail( 'thumb-square' );
								else :
									the_post_thumbnail( 'thumb-square' );
								endif;
							break;
							default:
								if ( $num==1 ) :
									the_post_thumbnail( 'thumb-square' );
								elseif ( $num==2 ) :
									the_post_thumbnail( 'thumb-long' );
								else :
									the_post_thumbnail( 'thumb-square' );
								endif;
							break;
						endswitch;
					endwhile; wp_reset_postdata(); ?>
					</div>
				</a>
			</article><?php
		endforeach; ?>
	</div><!-- /.row -->
</section><!-- /#portfolio -->

<?php get_footer();