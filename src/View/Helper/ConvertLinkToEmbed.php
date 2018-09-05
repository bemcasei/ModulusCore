<?php

namespace ModulusCore\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Convert video link YouTube and Vimeo to embed
 *
 * @category ModulusCore
 * @package View\Helper
 * @author  William Hoffmann <williamhoffmann@outlook.com>
 */
class ConvertLinkToEmbed extends AbstractHelper
{
    public function __invoke($videoLink)
    {
        $parseUrl = parse_url($videoLink);
        $host = $parseUrl['host'];
        if ($host == 'vimeo.com') {
            $url = explode('vimeo.com/', $videoLink);
            $embed = '//player.vimeo.com/video/' . $url[1];
        } else {
            $search  = '#(.*?)(?:href="https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch?.*?v=))([\w\-]{10,12}).*#x';
            $replace = 'http://www.youtube.com/embed/$2';
            $embed   = preg_replace($search, $replace, $videoLink);
        }

        return $embed;
    }
}
