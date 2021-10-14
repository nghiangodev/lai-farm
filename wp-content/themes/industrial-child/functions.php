<?php

function my_theme_enqueue_styles()
{

    $parent_style = 'boldthemes_style_css';

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.crush.css');
    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/style.css',
        [$parent_style],
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function load_scripts()
{
    wp_enqueue_style('font-awesome', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css', [], false);
    wp_enqueue_style('bs4-v5.1.3', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', [], false);
    wp_enqueue_style('bs4-js-v5.1.3', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', [], false);
}

add_action('wp_enqueue_scripts', 'load_scripts');

?>
