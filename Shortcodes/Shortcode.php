<?php

namespace VDLazyLoadYouTube\Shortcodes;

class Shortcode
{

    /**
     * Can this shortcode tag be changed?
     * 
     * @var boolean
     */
    protected $user_editable = false;

    /**
     * Shortcode arguments
     * 
     * @var array
     */
    public $args = [];

    /**
     * Shortcode value
     * 
     * @var array
     */
    public $value = '';

    /**
     * New instance of the class
     * 
     * @return \VDLazyLoadYouTube\Shortcodes\Shortcode
     */
    public function __construct()
    {
        $this->register_shortcode();
    }
    
    /**
     * Register shortcode within WordPress
     * 
     * @return void
     */
    private function register_shortcode() {
        if($this->user_editable) {
            $this->shortcode = get_option('vdlzyoutube_shortcode_' . $this->shortcode, $this->shortcode);
        }

        add_shortcode($this->shortcode, array($this, 'handle_shortcode'));
    }



    /**
     * Handle shortcode
     * 
     * @param  array $atts
     * @param  string $content
     * @return void
     */
    public function handle_shortcode($atts, $content = '') {
        $this->args = $atts;
        $this->value = $content;
        return $this->render();
    }
    

    /**
     * Render the shortcode
     * 
     * @return string
     */
    public function render() {
        return '';
    }

}