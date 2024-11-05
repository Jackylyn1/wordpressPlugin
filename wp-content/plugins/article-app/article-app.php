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
/**
 * Class Article_App
 *
 * Handles the setup and rendering of the "Article App" for the WordPress front end
 * and editor, including script and style registration.
 */
class Article_App {

    /**
     * Absolute path to the assets directory on the server.
     * 
     * @var string
     */
    protected $absolute_assets_path;

    /**
     * Relative path to the assets directory from the plugin directory.
     * 
     * @var string
     */
    protected $relative_assets_path;

    /**
     * Constructor for the Article_App class.
     *
     * Sets the assets paths, registers the shortcode, and enqueues scripts for both
     * front-end and editor.
     *
     * @param string $subfolder_assets Optional. Relative subfolder for assets. Default 'dist/assets/'.
     */
    public function __construct($subfolder_assets = 'dist/assets/') {
        $this->relative_assets_path = $subfolder_assets;
        $this->absolute_assets_path = plugin_dir_path(__FILE__) . $this->relative_assets_path;
        \add_shortcode('article_app', [$this, 'article_app_render']);
        \add_action('wp_enqueue_scripts', [$this, 'article_app_plugin_enqueue_scripts']);
        \add_action('enqueue_block_editor_assets', [$this, 'register_article_overview_editor_button']);
        \add_action('init', [$this, 'register_article_overview_block']);
    }

    /**
     * Renders the front-end placeholder for the Article App shortcode.
     *
     * This outputs a div with an ID that can be used by JavaScript to render
     * the app.
     *
     * @return string HTML markup for the Article App container.
     */
    public function article_app_render() {
        return '<div id="article-app" class="alignfull"></div>';
    }

    /**
     * Registers JavaScript files found in the assets directory.
     *
     * Enqueues each `.js` file in the assets directory for front-end use.
     *
     * @return void
     */
    private function register_js() {
        foreach (glob($this->absolute_assets_path . '*.js') as $js_filename) {
            wp_enqueue_script(
                'article-app',
                plugins_url($this->relative_assets_path . basename($js_filename), __FILE__),
                array('wp-element'),
                '1.0',
                true
            );
        }
    }

    /**
     * Registers CSS files found in the assets directory.
     *
     * Enqueues each `.css` file in the assets directory for front-end styling.
     *
     * @return void
     */
    private function register_css() {
        foreach (glob($this->absolute_assets_path . '*.css') as $css_filename) {
            wp_enqueue_style(
                'article-app',
                plugins_url($this->relative_assets_path . basename($css_filename), __FILE__),
                array(),
                '1.0'
            );
        }
    }

    /**
     * Enqueues both CSS and JavaScript assets for the front end.
     *
     * This method is called during the `wp_enqueue_scripts` action.
     *
     * @return void
     */
    public function article_app_plugin_enqueue_scripts() {
        $this->register_css();
        $this->register_js();
    }
    
    /**
     * Enqueues JavaScript for the block editor button in the Gutenberg editor.
     *
     * Registers the `article-overview-block.js` script, which adds a custom button to the block editor.
     *
     * @return void
     */
    public function register_article_overview_editor_button() {
        wp_enqueue_script(
            'article-overview-block',
            plugins_url('article-overview-block.js', __FILE__),
            array('wp-blocks', 'wp-element', 'wp-editor', 'wp-data'),
            filemtime(plugin_dir_path(__FILE__) . 'article-overview-block.js')
        );
    }

    /**
     * Registers the custom 'Article Overview' block with a render callback
     * that processes the [article_app] shortcode on the front end.
     *
     * This function registers a block type that will render dynamically
     * using the output of the [article_app] shortcode.
     *
     * @return void
     */
    function register_article_overview_block() {
        register_block_type('custom/article-overview', array(
            'render_callback' => function() {
                return do_shortcode('[article_app]');
            }
        ));
    }
}

new Article_App();