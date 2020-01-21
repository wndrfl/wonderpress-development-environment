<?php

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

if ( function_exists( 'add_theme_support' ) ) {
	// Add Menu Support
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large', 700, '', true ); // Large Thumbnail
	add_image_size( 'medium', 250, '', true ); // Medium Thumbnail
	add_image_size( 'small', 120, '', true ); // Small Thumbnail
	//add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	//add_theme_support( 'post-formats', array( 'video' ) );

	// Enables post and comment RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Localisation Support
	//load_theme_textdomain('skellie', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// skellie Blank navigation
function skellie_nav( $location = 'header-menu' ) {
	wp_nav_menu(
		array(
			'theme_location'  => $location,
			'menu'            => '',
			'container'       => 'div',
			'container_class' => 'menu-{menu slug}-container',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul>%3$s</ul>',
			'depth'           => 0,
			'walker'          => '',
		)
	);
}

function skellie_header_scripts() {
	if ( 'wp-login.php' !== $GLOBALS['pagenow'] && ! is_admin() ) {

		// remove jquery
		wp_deregister_script( 'jquery' );

		if ( WP_DEBUG ) {
			wp_register_script( 'custom', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0' ); // Custom scripts
		} else {
			wp_register_script( 'custom', get_template_directory_uri() . '/js/scripts.min.js', array(), '1.0.0' ); // Custom scripts
		}
		wp_enqueue_script( 'custom' ); // Enqueue it!
	}
}

// Load skellie Blank conditional scripts
function skellie_conditional_scripts() {
	// if (is_page('pagenamehere')) {
	//     wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
	//     wp_enqueue_script('scriptname'); // Enqueue it!
	// }
}

// Load skellie Blank styles
function skellie_styles() {
	// remove dashicons
	wp_deregister_style( 'dashicons' );

	wp_register_style( 'fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,600', array(), '1.0', 'all' );
	wp_enqueue_style( 'fonts' ); // Enqueue it!

	//wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '1.0', 'all');
	//wp_enqueue_style('fontawesome'); // Enqueue it!

	wp_register_style( 'theme', get_template_directory_uri() . '/css/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'theme' ); // Enqueue it!
}

// Register skellie Blank Navigation
function register_skellie_menu() {
	register_nav_menus(
		array( // Using array to specify more menus if needed
			'header-menu'  => 'Header Menu', // Main Navigation
			'sidebar-menu' => 'Sidebar Menu', // Sidebar Navigation
			'footer-menu'  => 'Footer Menu',
		)
	);
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter( $var ) {
	return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list( $thelist ) {
	return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers WordPress Theme
function add_slug_to_body_class( $classes ) {
	global $post;
	if ( is_home() ) {
		$key = array_search( 'blog', $classes, true );
		if ( $key > -1 ) {
			unset( $classes[ $key ] );
		}
	} elseif ( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}

	return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	return $html;
}


// If Dynamic Sidebar Exists
if ( function_exists( 'register_sidebar' ) ) {
	// Define Sidebar Widget Area 1
	register_sidebar(
		array(
			'name'          => 'Widget Area 1',
			'description'   => 'Description for this widget-area...',
			'id'            => 'widget-area-1',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	// Define Sidebar Widget Area 2
	register_sidebar(
		array(
			'name'          => 'Widget Area 2',
			'description'   => 'Description for this widget-area...',
			'id'            => 'widget-area-2',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action(
		'wp_head',
		array(
			$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
			'recent_comments_style',
		)
	);
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function skellie_pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links(
		array(
			'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format'  => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total'   => $wp_query->max_num_pages,
		)
	);
}

// Custom Excerpts
function skellie_index( $length ) {
	// Create 20 Word Callback for Index page Excerpts, call using skellie_excerpt('skellie_index');
	return 50;
}

// Create 40 Word Callback for Custom Post Excerpts, call using skellie_excerpt('skellie_custom_post');
function skellie_custom_post( $length ) {
	return 40;
}

// Create the Custom Excerpts callback
function skellie_excerpt( $length_callback = '', $more_callback = '' ) {
	global $post;
	if ( function_exists( $length_callback ) ) {
		add_filter( 'excerpt_length', $length_callback );
	}
	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	$output = '<p>' . $output . '</p>';
	echo $output;
}

// Custom View Article link to Post
function skellie_blank_view_article( $more ) {
	global $post;
	return '...<br /><a class="btn btn-orange" href="' . get_permalink( $post->ID ) . '">' . __( 'Read More', 'skellie' ) . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
	return false;
}

// Remove 'text/css' from our enqueued stylesheet
function skellie_style_remove( $tag ) {
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
	return $html;
}

// Custom Gravatar in Settings > Discussion
function skelliegravatar( $avatar_defaults ) {
	$myavatar                     = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[ $myavatar ] = 'Custom Gravatar';
	return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments() {
	if ( ! is_admin() ) {
		if ( is_singular() and comments_open() and ( get_option( 'thread_comments' ) === 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action( 'init', 'skellie_header_scripts' ); // Add Custom Scripts to wp_head
add_action( 'wp_print_scripts', 'skellie_conditional_scripts' ); // Add Conditional Page Scripts
add_action( 'get_header', 'enable_threaded_comments' ); // Enable Threaded Comments
add_action( 'wp_enqueue_scripts', 'skellie_styles' ); // Add Theme Stylesheet
add_action( 'init', 'register_skellie_menu' ); // Add Skellie Blank Menu
add_action( 'init', 'create_post_type_skellie' ); // Add our Skellie Blank Custom Post Type
add_action( 'widgets_init', 'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action( 'init', 'skellie_pagination' ); // Add our skellie Pagination

// Remove Actions
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // Index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Add Filters
add_filter( 'avatar_defaults', 'skelliegravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'excerpt_more', 'skellie_blank_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar
add_filter( 'style_loader_tag', 'skellie_style_remove' ); // Remove 'text/css' from enqueued stylesheet
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode( 'skellie_shortcode_demo', 'skellie_shortcode_demo' ); // You can place [skellie_shortcode_demo] in Pages, Posts now.
add_shortcode( 'skellie_shortcode_demo_2', 'skellie_shortcode_demo_2' ); // Place [skellie_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [skellie_shortcode_demo] [skellie_shortcode_demo_2] Here's the page title! [/skellie_shortcode_demo_2] [/skellie_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo
function create_post_type_skellie() {
	//register_taxonomy_for_object_type('category', 'inventory-item'); // Register Taxonomies for Category
	//register_taxonomy_for_object_type('post_tag', 'inventory-item');
	register_post_type(
		'sample-type', // Register Custom Post Type
		array(
			'labels'       => array(
				'name'               => __( 'Sample Types' ), // Rename these to suit
				'singular_name'      => __( 'Sample Type' ),
				'add_new'            => __( 'Add New' ),
				'add_new_item'       => __( 'Add New Sample Type' ),
				'edit'               => __( 'Edit' ),
				'edit_item'          => __( 'Edit Sample Type' ),
				'new_item'           => __( 'New Sample Type' ),
				'view'               => __( 'View Sample Type' ),
				'view_item'          => __( 'View Sample Type' ),
				'search_items'       => __( 'Search Sample Types' ),
				'not_found'          => __( 'No Sample Types found' ),
				'not_found_in_trash' => __( 'No Sample Types found in Trash' ),
			),
			'public'       => true,
			'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
			'has_archive'  => true,
			'supports'     => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
			),
			'can_export'   => true, // Allows export in Tools > Export
			'taxonomies'   => array(
				//'post_tag',
				//'category'
			), // Add Category and Post Tags support
		)
	);

	// create a new taxonomy
	register_taxonomy(
		'sample-type-category',
		'sample-type',
		array(
			'label'             => __( 'Sample Type Categories' ),
			'rewrite'           => array(
				'slug'       => 'shop',
				'with_front' => true,
			),
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
		)
	);
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function skellie_shortcode_demo( $atts, $content = null ) {
	return '<div class="shortcode-demo">' . do_shortcode( $content ) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function skellie_shortcode_demo_2( $atts, $content = null ) {
	// Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
	return '<h2>' . $content . '</h2>';
}

function skellie_breadcrumbs() {
	global $post;
	echo '<ul class="breadcrumbs hidden-xs">';
	echo '<li><a href="';
	echo get_option( 'home' );
	echo '">';
	echo 'Home';
	echo '</a></li><li class="separator"><i class="fa fa-chevron-right"></i></li>';

	if ( ! is_home() ) {

		if ( is_category() || is_tax() || is_single() ) {
			echo '<li>';
			if ( is_category() ) {
				echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">Resource Center</a>';
				echo '</li><li class="separator"><i class="fa fa-chevron-right"></i></li><li>';
				the_category( '</li><li class="separator"><i class="fa fa-chevron-right"></i></li><li> ' );
			} elseif ( is_tax() ) {
				echo '<a href="' . get_post_type_archive_link( 'inventory-item' ) . '">Browse</a>';
				echo '</li><li class="separator"><i class="fa fa-chevron-right"></i></li><li>';
				single_cat_title( '', true );
			} elseif ( is_single() ) {

				if ( get_post_type() === 'inventory-item' ) {
					echo '<a href="' . get_post_type_archive_link( 'inventory-item' ) . '">Browse</a>';
					echo '</li><li class="separator"><i class="fa fa-chevron-right"></i></li><li>';
					$terms = wp_get_post_terms( null, 'inventory_category' );
					if ( $terms ) {
						echo $terms[0];
						echo '</li><li class="separator"><i class="fa fa-chevron-right"></i></li><li>';
					}
				} else {
					echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">Resource Center</a>';
					echo '</li><li class="separator"><i class="fa fa-chevron-right"></i></li><li>';
				}
				the_title();
				echo '</li>';
			}
		} elseif ( is_page() ) {
			if ( $post->post_parent ) {
				$anc   = get_post_ancestors( $post->ID );
				$title = get_the_title();
				foreach ( $anc as $ancestor ) {
					$output = '<li><a href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li> <li class="separator"><i class="fa fa-chevron-right"></i></li>';
				}
				echo $output;
				echo '<strong title="' . $title . '"> ' . $title . '</strong>';
			} else {
				echo '<li><strong> ' . get_the_title() . '</strong></li>';
			}
		} elseif ( is_404() ) {
			echo"<li>We can't find that page (404)</li>";
		} elseif ( is_search() ) {
			echo'<li>Search Results';
			echo'</li>';
		} else {
			echo '<li>Browse</li>';
		}
	} elseif ( is_tag() ) {
		single_tag_title();} elseif ( is_day() ) {
		echo'<li>Archive for ';
		the_time( 'F jS, Y' );
		echo'</li>';} elseif ( is_month() ) {
			echo'<li>Archive for ';
			the_time( 'F, Y' );
			echo'</li>';} elseif ( is_year() ) {
			echo'<li>Archive for ';
			the_time( 'Y' );
			echo'</li>';} elseif ( is_author() ) {
				echo'<li>Author Archive';
				echo'</li>';} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
				echo '<li>Blog Archives';
				echo'</li>';} elseif ( is_search() ) {
					echo'<li>Search Results';
					echo'</li>';} else {
						echo '<li><strong>Resource Center</strong></li>';}
					echo '</ul>';
}


if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Theme Social Settings',
			'menu_title'  => 'Social / Links',
			'parent_slug' => 'theme-general-settings',
		)
	);

	// acf_add_options_sub_page(array(
	//     'page_title'    => 'Theme Footer Settings',
	//     'menu_title'    => 'Footer',
	//     'parent_slug'   => 'theme-general-settings',
	// ));

}
