<?php
/**
 * Custom template tags for Flatfolio
 *
 * @package WordPress
 * @subpackage Flatfolio
 */

function ff_gallery($gal) {
	if (!$gal) { return false; }
	$gal_items = get_posts( array(
		'posts_per_page' => -1,
		'gallery' => $gal->slug,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => 'attachment'
	) ); ?>
	<div id="slideshow"><?php $num=0;
		foreach ($gal_items as $key => $item) : $num++; ?>
			<div class="slide" id="slide-<?php echo $num; ?>"><?php
				echo wp_get_attachment_image( $item->ID, 'slide-size', false, array('class'=>'img-responsive') ); ?>
			</div><?php
		endforeach; ?>
	</div><!--/#slideshow-->
	<div id="slideshow-thumbs"><?php $num=0;
		foreach ($gal_items as $key => $item) : $num++; ?>
			<div class="thumb" id="thumb-<?php echo $num; ?>"><?php
				$classes = $num==1 ? 'active-thumb img-thumbnail img-responsive' : 'img-thumbnail img-responsive';
				echo wp_get_attachment_image( $item->ID, 'thumbnail', false, array('class'=>$classes) );
				// echo $item->post_title;
				// echo $item->post_excerpt; ?>
			</div><?php
		endforeach; ?>
	</div><!--/#slideshow-thumbs--><?php
}