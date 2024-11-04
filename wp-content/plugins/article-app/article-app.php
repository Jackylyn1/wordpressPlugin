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

class Article_App {
    protected $absolute_assets_path;
    protected $relative_assets_path;

    public function __construct($subfolder_assets = 'dist/assets/'){
        $this->relative_assets_path = $subfolder_assets;
        $this->absolute_assets_path = plugin_dir_path(__FILE__) . $this->relative_assets_path;
        \add_action('wp_enqueue_scripts', 
        [$this, 'article_app_plugin_enqueue_scripts']);
        \add_shortcode('article_app', 
        [$this, 'article_app_render']);
    }

    public function article_app_render(){
        return '<div id="article-app" class="alignfull"></div>';
    }

    private function register_js(){
        foreach(glob($this->absolute_assets_path . '*.js') as $js_filename){
            wp_enqueue_script(
                'article-app',
                plugins_url($this->relative_assets_path . basename($js_filename), __FILE__),
                array('wp-element'),
                '1.0',
                true
            );
        }
    }

    private function register_css(){
        foreach(glob($this->absolute_assets_path . '*.css') as $css_filename){
            wp_enqueue_style(
                'article-app',
                plugins_url($this->relative_assets_path . basename($css_filename), __FILE__),
            array(),
            '1.0'  
            );
        }
    }

    public function article_app_plugin_enqueue_scripts(){
        $this->register_css();
        $this->register_js();
    }
}

new Article_App();