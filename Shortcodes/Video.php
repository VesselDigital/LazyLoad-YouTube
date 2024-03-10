<?php

namespace VDLazyLoadYouTube\Shortcodes;

use VDLazyLoadYouTube\Util\YouTubeUtils;

class Video extends Shortcode
{

    /**
     * Shortcode tag
     * 
     * @var string
     */
    public $shortcode = "lazyload_youtube_video";


    /**
     * Render the shortcode
     * 
     * @return string
     */
    public function render()
    {   
        $value = $this->value;
        if($value == "" && isset($this->args["url"])) {
            $value = $this->args["url"];
        }
        $preview = YouTubeUtils::generatePreview($value);
        return $preview;
    }
}