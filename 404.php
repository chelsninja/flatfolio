<?php
/**
 * 404 Template
 * Description: Displays 404 pages (Not Found)
 *
 * @package Wordpress
 * @subpackage Flatfolio
 */
get_header(); ?>

<section class="container">
	<h2>Page Not Found</h2>
	<p class="lead">It seems we can't find what you're looking for. Perhaps searching keywords or clicking one of the links below can help.</p>
	<div class="well well-lg"><?php get_search_form(); ?></div>
</section><?php

get_footer();