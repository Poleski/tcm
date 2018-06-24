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
    wp_enqueue_style( 'magnific-popup-css', get_template_directory_uri() . '/css/magnific-popup/magnific-popup.css', null, '1.1.0' );
    wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/css/ui/jquery-ui.min.css', null, '1.12.1' );
    wp_enqueue_style( 'jquery-ui-structure', get_template_directory_uri() . '/css/ui/jquery-ui.structure.min.css', null, '1.12.1' );
    wp_enqueue_style( 'jquery-ui-theme', get_template_directory_uri() . '/css/ui/jquery-ui.theme.min.css', null, '1.12.1' );

	wp_enqueue_script( 'methanol-navigation', get_template_directory_uri() . '/js/core/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'methanol-skip-link-focus-fix', get_template_directory_uri() . '/js/core/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/vendor/slick.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'nav', get_template_directory_uri() . '/js/vendor/jquery-nav.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/vendor/jquery-magnific-popup.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/js/vendor/jquery-ui.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery', 'nav', 'slick', 'jquery-ui'), null, true );

    wp_register_style( 'google_fonts' , '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i&amp;subset=latin-ext');
    wp_enqueue_style('google_fonts');
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
                    'editor',
                    'page-attributes'
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
                    'editor',
                    'page-attributes',
                    'thumbnail'
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

/* Custom page fields */

function add_custom_metaboxes() {
    global $post;

    // General meta boxes

    add_meta_box('page_background_color', 'Add background color?', 'page_background_color_checkbox', 'page', 'side', 'low');
    add_meta_box('page_title_remove', 'Remove title?', 'page_title_remove_checkbox', 'page', 'side', 'low');
    add_meta_box('page_padding_remove', 'Remove padding?', 'page_padding_remove_checkbox', 'page', 'side', 'low');

    add_meta_box('member_short_description', 'Short description', 'member_short_description_input', 'member', 'normal', 'low');
    add_meta_box('testimonial_subtitle', 'Subtitle', 'testimonial_subtitle_input', 'testimonial', 'normal', 'low');

    // Template specific meta boxes

    if (!empty($post)) {
        $post_template = get_post_meta( $post->ID, '_wp_page_template', true );

        if ( 'template-members.php' == $post_template || 'template-faqs.php' == $post_template || 'template-testimonials.php' == $post_template  ) {
            add_meta_box('custom_category_filter', 'Filter categories', "custom_category_filter_input", 'page', 'side', 'low');
        }
    }
}

add_action('add_meta_boxes', 'add_custom_metaboxes' );

// Custom meta boxes  HTML

function page_title_remove_checkbox() {
    global $post;
    echo '<input type="hidden" name="meta_blog_noncename" id="meta_blog_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    $title_disabled = get_post_meta($post->ID, 'page_title_remove', true);
    $title_disabled_check = ($title_disabled == "on") ? "checked" : "";
    echo '<input type="checkbox" name="page_title_remove" ' . $title_disabled_check . ' />';
};

function page_padding_remove_checkbox() {
    global $post;
    echo '<input type="hidden" name="meta_blog_noncename" id="meta_blog_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    $padding_disabled = get_post_meta($post->ID, 'page_padding_remove', true);
    $padding_disabled_check = ($padding_disabled == "on") ? "checked" : "";
    echo '<input type="checkbox" name="page_padding_remove" ' . $padding_disabled_check . ' />';
};


function page_background_color_checkbox() {
    global $post;
    echo '<input type="hidden" name="meta_blog_noncename" id="meta_blog_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    $page_background_color = get_post_meta($post->ID, 'page_background_color', true);
    $page_background_color_check = ($page_background_color == "on") ? "checked" : "";
    echo '<input type="checkbox" name="page_background_color" ' . $page_background_color_check . ' />';
};

function member_short_description_input() {
    global $post;
    echo '<input type="hidden" name="meta_priv_noncename" id="meta_priv_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    echo '<input type="text" class="full-width" name="member_short_description" value="' . get_post_meta($post->ID, 'member_short_description', true)  . '" />';
};

function testimonial_subtitle_input() {
    global $post;
    echo '<input type="hidden" name="meta_priv_noncename" id="meta_priv_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    echo '<input type="text" class="full-width" name="testimonial_subtitle" value="' . get_post_meta($post->ID, 'testimonial_subtitle', true)  . '" />';
};

function custom_category_filter_input() {
    global $post;
    echo '<input type="hidden" name="meta_priv_noncename" id="meta_priv_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    echo '<input type="text" class="full-width" name="custom_category_filter" value="' . get_post_meta($post->ID, 'custom_category_filter', true)  . '" />';
};

// Saving custom meta boxes

function save_custom_page_metaboxes($post_id, $post) {

    if( $post->post_type !== 'page' ) {
        return $post->ID;
    }

    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
    }

    $custom_meta['page_background_color'] = $_POST['page_background_color'];
    $custom_meta['page_title_remove'] = $_POST['page_title_remove'];
    $custom_meta['page_padding_remove'] = $_POST['page_padding_remove'];
    $custom_meta['custom_category_filter'] = $_POST['custom_category_filter'];

    foreach ($custom_meta as $key => $value) {
        if( $post->post_type == 'revision' ) return;
        $value = implode(',', (array)$value);
        if(get_post_meta($post_id, $key, FALSE)) {
            update_post_meta($post_id, $key, $value);
        } else {
            add_post_meta($post_id, $key, $value);
        }
        if(!$value) delete_post_meta($post_id, $key);
    }
}

add_action('save_post', 'save_custom_page_metaboxes', 1, 2);

function save_custom_post_metaboxes($post_id, $post) {

    if ( !wp_verify_nonce( $_POST['meta_priv_noncename'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }

    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
    }


    $custom_meta['member_short_description'] = $_POST['member_short_description'];
    $custom_meta['testimonial_subtitle'] = $_POST['testimonial_subtitle'];

    foreach ($custom_meta as $key => $value) {
        if( $post->post_type == 'revision' ) return;
        $value = implode(',', (array)$value);
        if(get_post_meta($post_id, $key, FALSE)) {
            update_post_meta($post_id, $key, $value);
        } else {
            add_post_meta($post_id, $key, $value);
        }
        if(!$value) delete_post_meta($post_id, $key);
    }
}

add_action('save_post', 'save_custom_post_metaboxes', 2, 2);

function outlet_admin_styles() {
    echo '<style> .inside input.full-width { width: 100% } </style>';
}

add_action('admin_head', 'outlet_admin_styles');

// Widgets

function event_widgets_init() {
    for($i =1; $i<= 4; $i++){
        register_sidebar(array(
            'name' => __('Footer widget ', 'event') . $i,
            'id' => 'methanol_footer_'.$i,
            'description' => __('Displays footer widgets ', 'event').$i,
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}

add_action('widgets_init', 'event_widgets_init', 11);