<?php
/**
 * Wanderlust functions and definitions
 *
 * @package WordPress
 * @subpackage Flatfolio
 */

/**
 * Set up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

/**
 * Theme setup.
 *
 */
function ff_setup() {
	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add thumbnail sizes
	add_image_size( 'slide-size', 600 );
	add_image_size( 'thumb-square', 180, 180 );
	add_image_size( 'thumb-wide', 360, 180 );
	add_image_size( 'thumb-long', 180, 360 );

	// Register nav menu locations.
	register_nav_menus( array(
		'primary'   => __( 'Side primary menu', 'flatfolio' )
	) );

	// Switch default core markup to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
}
add_action( 'after_setup_theme', 'ff_setup' );

/**
 * Register custom init functions.
 *
 * @return void
 */
function wanderlust_init() {
	add_post_type_support( 'post', 'page-attributes' );
	add_post_type_support( 'attachment', 'page-attributes' );
	$labels = array(
		'name'              => _x( 'Galleries', 'taxonomy general name' ),
		'singular_name'     => _x( 'Gallery', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Galleries' ),
		'all_items'         => __( 'All Galleries' ),
		'parent_item'       => __( 'Parent Gallery' ),
		'parent_item_colon' => __( 'Parent Gallery:' ),
		'edit_item'         => __( 'Edit Gallery' ),
		'update_item'       => __( 'Update Gallery' ),
		'add_new_item'      => __( 'Add New Gallery' ),
		'new_item_name'     => __( 'New Gallery Name' ),
		'menu_name'         => __( 'Gallery' )
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'gallery' )
	);
	register_taxonomy( 'gallery', array( 'attachment' ), $args );
}
add_action( 'init', 'wanderlust_init' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @return void
 */
function wanderlust_scripts() {
	// Load latest jQuery.
	wp_enqueue_script( 'jquery' );

	// Load Modernizr & Reset.
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js' );
	wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css' );

	// Load main stylesheet & script.
	wp_enqueue_style( 'wanderlust-css', get_stylesheet_uri(), array( 'reset', 'bootstrap-css' ) );
	wp_enqueue_script( 'wanderlust-js', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );

	// Load responsive stylesheets.
	wp_enqueue_style( 'tablet-css', get_template_directory_uri() . '/css/tablet.css', array( 'wanderlust-css' ), '1.0', 'only screen and (max-width: 980px)' );
	wp_enqueue_style( 'mobile-css', get_template_directory_uri() . '/css/mobile.css', array( 'tablet-css' ), '1.0', 'only screen and (max-width: 700px)' );

	// Load Bootstrap scripts & styles.
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ) );

	// Load Font Awesome fonts.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

	// Load the Internet Explorer scripts & styles.
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.js' );
	#wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style', 'genericons' ), '20131205' );
}
add_action( 'wp_enqueue_scripts', 'wanderlust_scripts' );

/**
 * @todo add description
 *
 * @return void
 */
function wl_project_gallery_meta( $post ) { ?>
	<label for="project_gallery">Choose gallery for slideshow: </label><?php
	wp_dropdown_categories( array(
		'show_option_none' => 'None',
		'selected' => get_post_meta( $post->ID, 'project_gallery', true ),
		'name' => 'project_gallery',
		'class' => 'postform wl-project-gallery-dropdown',
		'taxonomy' => 'gallery'
	) ); ?>
	<script type="text/javascript">
        jQuery(document).ready(function($){
            $('.wl-project-gallery-dropdown').change(function(){
                if( $(this).val()!=-1 ) {
                    $(this).siblings().each(function(){
                        $(this).val(-1);
                    });
                }
            });
        });
	</script>
<?php }

/**
 * @todo add description
 *
 * @return void
 */
function wanderlust_metaboxes(){
	add_meta_box( 'wl-project-gallery-meta', 'Project Gallery', 'wl_project_gallery_meta', 'post', 'normal', 'default' );
}
add_action( 'admin_init', 'wanderlust_metaboxes' );

/**
 * @todo add description
 *
 * @return void
 */
function wanderlust_save_meta( $post_id ){
	if ( isset($_POST['project_gallery']) ) {
		update_post_meta( $post_id, 'project_gallery', $_POST['project_gallery'] );
	}
}
add_action( 'save_post', 'wanderlust_save_meta' );

/**
 * @todo add description
 *
 * @return void
 */
function wanderlust_category_meta( $tag ) {
    $cat_layout = get_option( 'category_'.$tag->term_id, 'layout1' ); ?>
    <table id="wl-cat-form" class="form-table">
		<tbody>
		    <tr class="form-field">
				<th valign="top" scope="row"><label for="cat_layout">Layout</label></th>
				<td>
					<label class="radio-inline">
						<input type="radio" id="cat-layout" name="cat_layout" value="layout1" <?php echo $cat_layout=='layout1' ? 'checked' : ''; ?> />
						<img src="<?php echo get_template_directory_uri().'/img/layout-1.png' ?>" class="<?php echo $cat_layout=='layout1' ? 'selected' : ''; ?>" />
					</label>
					<label class="radio-inline">
						<input type="radio" id="cat-layout" name="cat_layout" value="layout2" <?php echo $cat_layout=='layout2' ? 'checked' : ''; ?> />
						<img src="<?php echo get_template_directory_uri().'/img/layout-2.png' ?>" class="<?php echo $cat_layout=='layout2' ? 'selected' : ''; ?>" />
					</label>
					<label class="radio-inline">
						<input type="radio" id="cat-layout" name="cat_layout" value="layout3" <?php echo $cat_layout=='layout3' ? 'checked' : ''; ?> />
						<img src="<?php echo get_template_directory_uri().'/img/layout-3.png' ?>" class="<?php echo $cat_layout=='layout3' ? 'selected' : ''; ?>" />
					</label>
					<label class="radio-inline">
						<input type="radio" id="cat-layout" name="cat_layout" value="layout4" <?php echo $cat_layout=='layout4' ? 'checked' : ''; ?> />
						<img src="<?php echo get_template_directory_uri().'/img/layout-4.png' ?>" class="<?php echo $cat_layout=='layout4' ? 'selected' : ''; ?>" />
					</label>
					<br>
					<span class="description">The layout preview of post thumbnails.</span>
				</td>
			</tr>
		</tbody>
	</table>
	<script type="text/javascript">
        jQuery(document).ready(function($){
            $('#wl-cat-form label').click(function(){
            	$('#wl-cat-form img').removeClass('selected');
                $('img',this).addClass('selected');
            });
        });
	</script>
<?php }
add_action( 'edit_category_form_fields', 'wanderlust_category_meta');

/**
 * @todo add description
 *
 * @return void
 */
function wanderlust_category_save_meta( $term_id ) {
    if ( isset( $_POST['cat_layout'] ) ) {
        update_option( 'category_'.$term_id, $_POST['cat_layout'] );
    }
}
add_action( 'edited_category', 'wanderlust_category_save_meta' );

/**
 * Enqueue scripts and styles for the back end.
 *
 * @return void
 */
function wanderlust_admin_scripts() {
	wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/css/admin.css' );

}
add_action( 'admin_enqueue_scripts', 'wanderlust_admin_scripts' );

/**
 * @todo add description
 *
 * @return void
 */
function wanderlust_menus() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'wanderlust_menus' );

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Index views.
 * 2. Presence of footer widgets.
 * 3. Single views.
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function wanderlust_body_classes( $classes ) {

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && !is_front_page() ) {
		$classes[] = 'singular';
	}

	return $classes;
}
add_filter( 'body_class', 'wanderlust_body_classes' );

/**
 * @todo add description
 *
 * @param string
 * @return string
 */
function wanderlust_search_form( $form ) {
    $form = '<form class="search-form form-inline" role="search" method="get" action="'.home_url( '/' ).'">
    <fieldset>
    <label class="sr-only" for="s">Search for:</label>
    <input class="form-control" type="text" value="'.get_search_query().'" name="s" placeholder="Search.." />
    <button type="search" class="btn btn-default" value="Search">
	<i class="fa fa-search"></i>
	</button>
    </fieldset>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'wanderlust_search_form' );

/**
 * @todo add description
 *
 * @return string
 */
function ff_breadcrumbs() {
	echo '<ol class="breadcrumb">';
	if ( !is_home() ) :
		echo '<li><a href="';
		echo get_permalink( get_option('page_for_posts') );
		echo '">';
		echo 'Portfolio';
		echo "</a></li>";
		if ( is_category() || is_single() ) :
			echo '<li>';
			the_category(' </li><li> ');
			if ( is_single() ) {
				echo "</li><li>";
				the_title();
				echo '</li>';
			}
		endif;
	endif;
	echo '</ol>';
}

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';