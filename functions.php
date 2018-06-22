<?php
/**
 * Methanol functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Methanol
 */

if ( ! function_exists( 'methanol_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function methanol_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Methanol, use a find and replace
		 * to change 'methanol' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'methanol', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'methanol' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'methanol_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'methanol_setup' );

function methanol_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'methanol_content_width', 640 );
}
add_action( 'after_setup_theme', 'methanol_content_width', 0 );

function methanol_scripts() {
	wp_enqueue_style( 'methanol-style', get_stylesheet_uri() );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick/slick.css', null, '1.8.1' );
    wp_enqueue_style( 'fa', get_template_directory_uri() . '/css/fa/fontawesome.css', null, '5.1.0' );
    wp_enqueue_style( 'fa-regular', get_template_directory_uri() . '/css/fa/regular.css', null, '5.1.0' );
    wp_enqueue_style( 'fa-solid', get_template_directory_uri() . '/css/fa/solid.css', null, '5.1.0' );

	wp_enqueue_script( 'methanol-navigation', get_template_directory_uri() . '/js/core/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'methanol-skip-link-focus-fix', get_template_directory_uri() . '/js/core/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/vendor/slick.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery', 'slick'), null, true );

}
add_action( 'wp_enqueue_scripts', 'methanol_scripts' );

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

/* Testimonials post */

function testimonial_post(){
    $labels =
        array(
            'name' => __( 'Testimonials', 'methanol'),
            'singular_name' => __('Testimonial', 'methanol'),
            'rewrite' =>
                array(
                    'slug' => __( 'testimonial', 'methanol' )
                ),
            'add_new' => _x('Add testimonial', 'testimonial', 'methanol'),
            'edit_item' => __('Edit testimoniale', 'methanol'),
            'new_item' => __('New testimonial', 'methanol'),
            'view_item' => __('View testimonial', 'methanol'),
            'search_items' => __('Search testimonial', 'methanol'),
            'not_found' =>  __('Testimonial not found', 'methanol'),
            'not_found_in_trash' => __('No testimonials in trash', 'methanol'),
            'parent_item_colon' => ''
        );

    $args =
        array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => null,
            'menu_icon' => 'dashicons-format-quote',
            'supports' =>
                array(
                    'title',
                    'editor',
                    'page-attributes',
                    'thumbnail'
                )
        );
    register_post_type(__( 'testimonial', 'methanol' ),$args);
}
add_action('init', 'testimonial_post');

function testimonial_messages($messages) {
    $post_ID = get_the_ID();

    $messages[__( 'testimonial' )] =
        array(
            0 => '',

            1 => sprintf(__('Testimonial updated. <a href="%s">View testimonial</a>'), esc_url(get_permalink($post_ID))),

            2 => __('Field updated', 'methanol'),

            3 => __('Field removed', 'methanol'),

            4 => __('Field updated', 'methanol'),

            5 => isset($_GET['revision']) ? sprintf( __('Testimonial reverted to version from %s', 'methanol'), wp_post_revision_title((int)$_GET['revision'],false)) : false,

            // Change the message once published
            6 => sprintf(__('Testimonial published. <a href="%s">View Testimonial</a>', 'methanol'), esc_url(get_permalink($post_ID))),

            7 => __('Testimonial saved.', 'methanol'),

            8 => sprintf(__('Testimonial submitted. <a target="_blank" href="%s">View Testimonial</a>', 'methanol'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),

            10 => sprintf(__('Testimonial draft updated. <a target="_blank" href="%s">View Testimonial</a>', 'methanol'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),
        );
    return $messages;
}
add_filter('post_updated_messages', 'testimonial_messages');

function testimonial_category_filter()
{
    // Register the Taxonomy
    register_taxonomy(__( "testimonial_category" , ''),

        // Assign the taxonomy to be part of the privilege post type
        array(__( "testimonial", 'methanol' )),

        // Apply the settings for the taxonomy
        array(
            "hierarchical" => true,
            "label" => __( "Testimonial categories", 'methanol' ),
            "singular_label" => __( "Testimonial category", 'methanol' ),
            "rewrite" => array(
                'slug' => 'testimonial_category',
                'hierarchical' => true
            )
        )
    );
}
add_action('init', 'testimonial_category_filter', 0 );

/* FAQ post */

function faq_post()
{
    $labels =
        array(
            'name' => __( 'FAQs', 'methanol'),
            'singular_name' => __('FAQ', 'methanol'),
            'rewrite' =>
                array(
                    'slug' => __( 'faq', 'methanol' )
                ),
            'add_new' => _x('Add FAQ', 'faq', 'methanol'),
            'edit_item' => __('Edit FAQ Item', 'methanol'),
            'new_item' => __('New FAQ Item', 'methanol'),
            'view_item' => __('View FAQ', 'methanol'),
            'search_items' => __('Search FAQ', 'methanol'),
            'not_found' =>  __('No FAQ Items Found', 'methanol'),
            'not_found_in_trash' => __('No FAQ Items Found In Trash', 'methanol'),
            'parent_item_colon' => ''
        );

    $args =
        array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => null,
            'supports' =>
                array(
                    'title',
                    'editor'
                )
        );
    register_post_type(__( 'faq', 'methanol' ),$args);
}
add_action('init', 'faq_post');

function faq_messages($messages)
{	$post_ID = get_the_ID();

    $messages[__( 'faq' )] =
        array(
            // Unused. Messages start at index 1
            0 => '',

            // Change the message once updated
            1 => sprintf(__('FAQ Updated. <a href="%s">View FAQ</a>'), esc_url(get_permalink($post_ID))),

            // Change the message if custom field has been updated
            2 => __('Custom Field Updated.', 'methanol'),

            // Change the message if custom field has been deleted
            3 => __('Custom Field Deleted.', 'methanol'),

            // Change the message once FAQ been updated
            4 => __('FAQ Updated.', 'methanol'),

            // Change the message during revisions
            5 => isset($_GET['revision']) ? sprintf( __('FAQ Restored To Revision From %s', 'methanol'), wp_post_revision_title((int)$_GET['revision'],false)) : false,

            // Change the message once published
            6 => sprintf(__('FAQ Published. <a href="%s">View FAQ</a>', 'methanol'), esc_url(get_permalink($post_ID))),

            // Change the message when saved
            7 => __('FAQ Saved.', 'methanol'),

            // Change the message when submitted item
            8 => sprintf(__('FAQ Submitted. <a target="_blank" href="%s">Preview FAQ</a>', 'methanol'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),

            // Change the message when a scheduled preview has been made
            //9 => sprintf(__('FAQ Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>', 'methanol'),date_i18n( __( 'M j, Y @ G:i' , 'methanol'),strtotime($post->post_date)), esc_url(get_permalink($post_ID))),

            // Change the message when draft has been made
            10 => sprintf(__('FAQ Draft Updated. <a target="_blank" href="%s">Preview FAQ</a>', 'methanol'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),
        );
    return $messages;
}
add_filter('post_updated_messages', 'faq_messages');

function faq_category_filter()
{
    // Register the Taxonomy
    register_taxonomy(__( "faq_category" , ''),

        // Assign the taxonomy to be part of the privilege post type
        array(__( "faq", 'methanol' )),

        // Apply the settings for the taxonomy
        array(
            "hierarchical" => true,
            "label" => __( "FAQ categories", 'methanol' ),
            "singular_label" => __( "FAQ category", 'methanol' ),
            "rewrite" => array(
                'slug' => 'faq_category',
                'hierarchical' => true
            )
        )
    );
}
add_action('init', 'faq_category_filter', 0 );

/* Member post */

function member_post()
{
    $labels =
        array(
            'name' => __( 'Members', 'methanol'),
            'singular_name' => __('Member', 'methanol'),
            'rewrite' =>
                array(
                    'slug' => __( 'member', 'methanol' )
                ),
            'add_new' => _x('Add member', 'member', 'methanol'),
            'edit_item' => __('Edit member', 'methanol'),
            'new_item' => __('New member', 'methanol'),
            'view_item' => __('View member', 'methanol'),
            'search_items' => __('Search member', 'methanol'),
            'not_found' =>  __('No member Items Found', 'methanol'),
            'not_found_in_trash' => __('No members  Items Found In Trash', 'methanol'),
            'parent_item_colon' => ''
        );

    $args =
        array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => null,
            'supports' =>
                array(
                    'title',
                    'editor'
                )
        );
    register_post_type(__( 'member', 'methanol' ),$args);
}
add_action('init', 'member_post');

function member_messages($messages)
{	$post_ID = get_the_ID();

    $messages[__( 'member' )] =
        array(
            // Unused. Messages start at index 1
            0 => '',

            // Change the message once updated
            1 => sprintf(__('Member Updated. <a href="%s">View Member</a>'), esc_url(get_permalink($post_ID))),

            // Change the message if custom field has been updated
            2 => __('Custom Field Updated.', 'methanol'),

            // Change the message if custom field has been deleted
            3 => __('Custom Field Deleted.', 'methanol'),

            // Change the message once FAQ been updated
            4 => __('Member Updated.', 'methanol'),

            // Change the message during revisions
            5 => isset($_GET['revision']) ? sprintf( __('Member Restored To Revision From %s', 'methanol'), wp_post_revision_title((int)$_GET['revision'],false)) : false,

            // Change the message once published
            6 => sprintf(__('Member Published. <a href="%s">View Member</a>', 'methanol'), esc_url(get_permalink($post_ID))),

            // Change the message when saved
            7 => __('Member Saved.', 'methanol'),

            // Change the message when submitted item
            8 => sprintf(__('Member Submitted. <a target="_blank" href="%s">Preview Member</a>', 'methanol'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),

            // Change the message when a scheduled preview has been made
            //9 => sprintf(__('FAQ Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>', 'methanol'),date_i18n( __( 'M j, Y @ G:i' , 'methanol'),strtotime($post->post_date)), esc_url(get_permalink($post_ID))),

            // Change the message when draft has been made
            10 => sprintf(__('Member Draft Updated. <a target="_blank" href="%s">Preview Member</a>', 'methanol'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),
        );
    return $messages;
}
add_filter('post_updated_messages', 'member_messages');

function member_category_filter()
{
    // Register the Taxonomy
    register_taxonomy(__( "member_category" , ''),

        // Assign the taxonomy to be part of the privilege post type
        array(__( "member", 'methanol' )),

        // Apply the settings for the taxonomy
        array(
            "hierarchical" => true,
            "label" => __( "Member categories", 'methanol' ),
            "singular_label" => __( "Member category", 'methanol' ),
            "rewrite" => array(
                'slug' => 'member_category',
                'hierarchical' => true
            )
        )
    );
}
add_action('init', 'member_category_filter', 0 );