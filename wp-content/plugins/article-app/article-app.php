<?php
/*
Plugin Name: Article App
Description: A React app embedded as a WordPress plugin, which gets the newest 12
articles from an API and shows them in a tile with image, cathegory, title, name 
of author.
Version: 1.0
Author: Jacqueline Urban
*/


defined('ABSPATH') || exit;

function article_app_plugin_enqueue_scripts(){
    wp_enqueue_script(
        'article-app',
        plugins_url('/dist/assets/index-Dxp5zAIY.js', __FILE__),
        array('wp-element'),
        '1.0',
        true
    );

    wp_enqueue_style(
        'article-app',
        plugins_url('/dist/assets/index-n_ryQ3BS.css'),
      array('wp-element'),
      '1.0'  
    );
}

add_action('wp_enqueue_scripts', 'article_app_plugin_enqueue_scripts');

function article_app_render(){
    return '<div id="article-app"></div>';
}

add_shortcode('article_app', 'article_app_render');

#add [article_app] if you want the app to be shown on a page