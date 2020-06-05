<?php

add_action ('wp_enqueue_scripts', 'style_theme');
add_action ('wp_footer', 'script_theme');
add_action ('after_setup_theme', 'theme_register_nav_menu_and_features');
add_action ('widgets_init', 'register_my_widgets');

add_action ('excerpt_categories', 'excerpt_categories');
add_action ('excerpt_home', 'excerpt_home');
// добавляет ссылку на пост в конце отрывка
//add_filter ('excerpt_more', 'new_excerpt_more');

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10);

add_filter ('document_title_separator', 'document_title_separator_filter');


function register_my_widgets ()
{
    register_sidebar (array (
        'name' => 'Right Sidebar',
        'id' => 'right-sidebar',
        'description' => 'Right Sidebar Description',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => "</div>\n",
        'before_title'  => '<h5 class="widgettitle">',
        'after_title'   => "</h5>\n",
    ) ) ;

    register_sidebar (array (
        'name' => 'Left Sidebar',
        'id' => 'left-sidebar',
        'description' => 'Left Sidebar Description',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => "</div>\n",
        'before_title'  => '<h5 class="widgettitle">',
        'after_title'   => "</h5>\n",
    ) ) ;

}

function theme_register_nav_menu_and_features ()
{
    register_nav_menu ('Top Menu', 'Top Menu');
    register_nav_menu ('Footer Menu', 'Footer Menu');
    add_theme_support ('title-tag');
    add_theme_support ('post-thumbnails', array( 'post' ) );
    add_image_size ('post_thumb', 1300, 500, true);
}

function style_theme()
{
    wp_enqueue_style ('style', get_stylesheet_uri() );

    wp_enqueue_style ('default', get_template_directory_uri() . '/assets/css/default.css');

    wp_enqueue_style ('layout', get_template_directory_uri() . '/assets/css/layout.css');

    wp_enqueue_style ('media-queries', get_template_directory_uri() . '/assets/css/media-queries.css');
}

function script_theme()
{
    wp_deregister_script ('jquery');

    wp_register_script ('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');

    wp_enqueue_script ('jquery');

    wp_enqueue_script ('jquery.flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', ['jquery'], null, true);

    wp_enqueue_script ('doubletaptogo', get_template_directory_uri() . '/assets/js/doubletaptogo.js', ['jquery'], null, true);

    wp_enqueue_script ('init', get_template_directory_uri() . '/assets/js/init.js', ['jquery'], null, true);

    wp_enqueue_script ('init', get_template_directory_uri() . '/assets/js/modernizr.js',null, null, false );

}

function new_categories_excerpt_more ()
{
    global $post;
    return '<a href="' . get_permalink ($post) . '"> read more...</a>';
}

function excerpt_categories ()
{
    echo "my excerpt_categories hook";

    the_excerpt();

    add_action ('excerpt_more', 'new_categories_excerpt_more');

}

function new_home_excerpt_more ()
{
    return '';
}

function excerpt_home ()
{
    the_excerpt();

    add_action ('excerpt_more', 'new_home_excerpt_more');
}

function my_navigation_template()
{
    /*
    Вид базового шаблона:
    <nav class="navigation %1$s" role="navigation">
        <h2 class="screen-reader-text">%2$s</h2>
        <div class="nav-links">%3$s</div>
    </nav>
    */

    return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

function document_title_separator_filter ($separator)
{
    $separator = '/';
    return $separator;
}
