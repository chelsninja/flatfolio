<?php
/**
 * Header Template
 * Description: Displays all of the <head> section and everything up till #main-content.
 *
 * @package WordPress
 * @subpackage Wanderlust
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header class="navbar-fixed-top">
			<div class="container">
				<h1 id="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<a class="sr-only" href="#main-content">Skip to main content</a>
				<i id="menu-icon" class="fa fa-bars fa-3x"></i>
			</div>
		</header>
		<nav id="primary-nav" role="navigation"><?php
			wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'nav nav-stacked' ) ); ?>
			<hr>
			<?php get_search_form(); ?>
			<hr>
			<div class="social-links">
				<a href="http://www.linkedin.com/in/chelsealorenz"><i class="fa fa-linkedin-square fa-3x"></i></a>
				<a href="https://github.com/cmlorenz"><i class="fa fa-github fa-3x"></i></a>
			</div>
		</nav>
		<section id="main-content">