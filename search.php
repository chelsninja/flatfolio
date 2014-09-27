<?php
/**
 * Search Template
 * Description: Displays search results pages.
 *
 * @package WordPress
 * @subpackage Flatfolio
 */
get_header(); ?>

<section class="container"><?php
    if ( have_posts() ) : ?>
        <h2><?php printf( 'Search Results for: %s', '<em>'.get_search_query().'</em>' ); ?></h2><?php
        while ( have_posts() ) : the_post(); ?>
            <article <?php post_class(); ?>>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h3><?php the_title();?></h3></a><?php
                the_excerpt(); ?>
            </article><!-- /.post_class --><?php
        endwhile;
    else : ?>
        <h2><?php printf( 'No Results Found for: %s', '<em>'.get_search_query().'</em>' ); ?></h2>
        <p class="lead">It seems we can't find what you're looking for. Perhaps you should try again with a different search term.</p>
        <div class="well well-lg"><?php get_search_form(); ?></div><?php
    endif; ?>
</section><?php

get_footer();