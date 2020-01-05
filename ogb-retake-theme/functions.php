<?php

function load_stylesheets()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false,  'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('font-awesome', get_template_directory_uri() . '/css/fontawesome-free/css/all.min.css', array(), false,  'all');
    wp_enqueue_style('font-awesome');

    wp_enqueue_style('Montserrat', "https://fonts.googleapis.com/css?family=Montserrat:700|Montserrat:normal|Montserrat:300");
    wp_enqueue_style('Kaushan_Script', "https://fonts.googleapis.com/css?family=Kaushan+Script");

    wp_register_style('icons', get_template_directory_uri() . '/css/simple-line-icons/css/simple-line-icons.css', array(), false,  'all');
    wp_enqueue_style('icons');

    // wp_register_style('landing', get_template_directory_uri() . '/css/creative/creative-v2.css', array(), false,  'all');
    // wp_enqueue_style('landing');

    wp_register_style('agency', get_template_directory_uri(). '/css/agency/agency.min.css', array(), false, 'all');
    wp_enqueue_style('agency');
    
    wp_register_style('custom', get_template_directory_uri() . '/style.css', array(), null, 'all');
    wp_enqueue_style('custom');

    if(is_page('jobs'))
    {
        wp_register_style('jobs', get_template_directory_uri() . '/css/jobs.css', array(), false,  'all');
        wp_enqueue_style('jobs');
    }

    if(is_singular('jobs')) {
        wp_register_style('jobs_single', get_template_directory_uri() . '/css/single-job.css', array(), false, 'all');
        wp_enqueue_style('jobs_single');
    }

    if(is_page('articles')) {
        wp_register_style('articles', get_template_directory_uri().'/css/articles.css', array(), null, 'all');
        wp_enqueue_style('articles');
    }
}

add_action('wp_enqueue_scripts', 'load_stylesheets');

function include_jquery()
{
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', '', 1, true);

    wp_register_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', '', 1, true);
    wp_enqueue_script('bootstrapjs');

    wp_register_script('agencyjs', get_template_directory_uri() . '/js/agency.min.js', '', 1, true);
    wp_enqueue_script('agencyjs');
}

add_action('wp_enqueue_scripts', 'include_jquery');


function loadjs()
{
    wp_register_script('customjs', get_template_directory_uri() . '/js/scripts.js', '', 1, true);
    wp_enqueue_script('customjs');
}

add_action('wp_enqueue_scripts', 'loadjs');

add_theme_support('menus');

add_theme_support('post-thumbnails');

register_nav_menus(
    array(
        'top-menu' => __('Top Menu', 'theme'),
        'footer-menu' => __('Footer Menu', 'theme')
    )
);

add_image_size('smallest', 300, 300, true);
add_image_size('largest', 800, 800, true);


function custom_excerpt_length( $length ) {
    return (is_front_page()) ? 15 : 60;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );