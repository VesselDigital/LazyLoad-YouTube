<?php
/**
 * Lazy Load YouTube
 *
 * Plugin Name: Lazy Load YouTube
 * Plugin URI:  https://vesseldigital.co.uk/
 * Description: Allows you to embed a lazy loading youtube video using either a shortcode or a guenberg block.
 * Version:     1.0
 * Author:      VesselDigital
 * Author URI:  https://vesseldigital.co.uk/
 * Text Domain: vesseldigital-lazy-youtube-video
 * Requires at least: 4.9
 * Requires PHP: 7.4
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */


if(!class_exists("VDLazyLoadYouTube")) {

    define("VD_LAZYLOAD_YOUTUBE_PATH", plugin_dir_path(__FILE__));
    define("VD_LAZYLOAD_YOUTUBE_URL", plugin_dir_url(__FILE__));
    define("VD_LAZYLOAD_YOUTUBE_VERSION", "1.0");

    class VDLazyLoadYouTube {
        

        /**
         * Shortcode instances
         */
        private $shortcodes = [];

        /**
         * New plugin instance
         */
        public function __construct()
        {
            // 
            $this->autoload_shortcodes();
            $this->autoload_util();

            add_action( 'wp_enqueue_scripts', [$this, "init_styles"] );
            add_action( 'wp_enqueue_scripts', [$this, "init_scripts"] );
            add_action( 'init', [$this, "register_lazyload_block"] );
        }

        /**
         * Register the shortcode
         */
        private function autoload_shortcodes() 
        {
            include_once __DIR__ . "/Shortcodes/Shortcode.php";
            include_once __DIR__ . "/Shortcodes/Video.php";


            $this->shortcodes["video"] = new \VDLazyLoadYouTube\Shortcodes\Video;
        }

        /**
         * Registers the block on server.
         */
        public function register_lazyload_block() {
            wp_register_script('vd-lazyload-youtube-block', VD_LAZYLOAD_YOUTUBE_URL . '/Resources/js/gutenberg/vesseldigital/lazyload-youtube.js');
            register_block_type_from_metadata(
                __DIR__ . '/Blocks/YouTubeEmbed',
                array(
                    'editor_script' => 'vd-lazyload-youtube-block',
                    'render_callback' => [ $this->shortcodes["video"], 'handle_shortcode'],
                )
            );
        }

        /**
         * Autoload the utils
         */
        private function autoload_util() 
        {
            include_once __DIR__ . "/Util/YouTubeUtils.php";
        }


        /**
         * Init styles
         */
        public function init_styles()
        {
            if(defined("WP_DEBUG") && WP_DEBUG) {
                wp_enqueue_style("vd-lazyload-youtube", VD_LAZYLOAD_YOUTUBE_URL . "Resources/css/style.css", [], VD_LAZYLOAD_YOUTUBE_VERSION);
            } else {
                wp_enqueue_style("vd-lazyload-youtube", VD_LAZYLOAD_YOUTUBE_URL . "Resources/css/style.min.css", [], VD_LAZYLOAD_YOUTUBE_VERSION);
            }
        }

        /**
         * Init scripts
         */
        public function init_scripts()
        {
            if(defined("WP_DEBUG") && WP_DEBUG) {
                wp_enqueue_script("vd-lazyload-youtube", VD_LAZYLOAD_YOUTUBE_URL . "Resources/js/app.js", [], VD_LAZYLOAD_YOUTUBE_VERSION, true);
            } else {
                wp_enqueue_script("vd-lazyload-youtube", VD_LAZYLOAD_YOUTUBE_URL . "Resources/js/app.min.js", [], VD_LAZYLOAD_YOUTUBE_VERSION, true);
            }
        }

    }

    $VesselDigitalLazyLoadYouTube = new VDLazyLoadYouTube;
}