<?php
/**
 * Main Template
 * Description: Displays a page when nothing more specific matches a query.
 *
 * @package Wordpress
 * @subpackage Wanderlust
 */
get_header(); ?>

<section class="container"><?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <div <?php post_class(); ?>>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <h3><?php the_title();?></h3>
                </a>
                <?php the_excerpt(); ?>
            </div><!-- /.post_class --><?php
        endwhile;
    endif; ?>
</section>

<?php get_footer();