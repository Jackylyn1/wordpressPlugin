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

class articleApp {
    protected $absolute_assets_path;
    protected $relative_assets_path;

    public function __construct($subfolderAssets = 'dist/assets/'){
        $this->relative_assets_path = $subfolderAssets;
        $this->absolute_assets_path = plugin_dir_path(__FILE__) . $this->relative_assets_path;
        \add_action('wp_enqueue_scripts', 
        [$this, 'article_app_plugin_enqueue_scripts']);
        \add_shortcode('article_app', 
        [$this, 'article_app_render']);
    }

    public function article_app_render(){
        return '<div id="article-app"></div>';
    }

    private function registerJS(){
        foreach(glob($this->absolute_assets_path . '*.js') as $jsfilename){
            wp_enqueue_script(
                'article-app',
                plugins_url($this->relative_assets_path . basename($jsfilename), __FILE__),
                array('wp-element'),
                '1.0',
                true
            );
        }
    }

    private function registerCSS(){
        foreach(glob($this->absolute_assets_path . '*.css') as $cssfilename){
            wp_enqueue_style(
                'article-app',
                plugins_url($this->relative_assets_path . basename($cssfilename), __FILE__),
            array('wp-element'),
            '1.0'  
            );
        }
    }

    public function article_app_plugin_enqueue_scripts(){
        $this->registerCSS();
        $this->registerJS();
    }
}

new articleApp();
#add [article_app] if you want the app to be shown on a page