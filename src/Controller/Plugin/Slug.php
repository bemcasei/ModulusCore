<?php

namespace ModulusCore\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Slug
 *
 * @category ModulusCore
 * @package Controller\Plugin
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class Slug extends AbstractPlugin
{
    /**
     * @param $url
     * @return null|string|string[]
     */
    public function __invoke($url)
    {
        return $this->clean($url);
    }

    /**
     * Clean string
     *
     * @param $str
     * @param array $replace
     * @param string $delimiter
     * @return null|string|string[]
     */
    public static function clean($str, $replace = [], $delimiter = '-')
    {
        if (! empty($replace)) {
            $str = str_replace((array) $replace, ' ', $str);
        }

        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
}
