<?php

namespace VDLazyLoadYouTube\Util;

class YouTubeUtils
{
    /**
     * Get the youtube iFrame from a url string
     */
    public static function convertYoutube($string) {
        return preg_replace(
            "/[a-zA-Z\/\/:\.]*youtu(?:be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)(?:[&?\/]t=)?(\d*)(?:[a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe width=\"420\" height=\"315\" src=\"https://www.youtube.com/embed/$1?start=$2\" frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>",
            $string
        );
    }
    /**
     * Get the youtube iFrame from a url string
     */
    public static function getYouTubeId($string) {
        return preg_replace(
            "/[a-zA-Z\/\/:\.]*youtu(?:be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)(?:[&?\/]t=)?(\d*)(?:[a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "$1",
            $string
        );
    }

    /**
     * Get the thumbnail from ID
     */
    public static function getThumbnailFromId($id = "") {
        return "https://img.youtube.com/vi/". $id ."/maxresdefault.jpg";
    }

    /**
     * Render the preview html from youtube url
     */
    public static function generatePreview($string) {

        ob_start();
        $id = self::getYouTubeId($string);
        $thumbnail = self::getThumbnailFromId($id);
        include __DIR__ . "/../Templates/Preview.php";
        $output = ob_get_clean();

        return $output;

    }
}