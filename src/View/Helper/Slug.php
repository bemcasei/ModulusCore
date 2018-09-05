<?php

namespace ModulusCore\View\Helper;

use ModulusCore\Controller\Plugin\Slug as SlugPlugin;
use Zend\View\Helper\AbstractHelper;

/**
 * Slug
 *
 * @category ModulusCore
 * @package View\Helper
 * @author  William Hoffmann <williamhoffmann@outlook.com>
 */
class Slug extends AbstractHelper
{
    /**
     * @var SlugPlugin
     */
    protected $slugPlugin;

    /**
     * @param null $string
     * @return $this|null|string|string[]
     */
    public function __invoke($string = null)
    {
        $this->getSplugPlugin();
        if ($string == null) {
            return $this;
        }

        return $this->slugPlugin->clean($string);
    }

    /**
     * Set slugPlugin
     *
     * @param SlugPlugin $slugPlugin
     * @return $this
     */
    public function setSplugPlugin(SlugPlugin $slugPlugin)
    {
        $this->slugPlugin = $slugPlugin;

        return $this;
    }

    /**
     * Get slugPlugin
     *
     * @return SlugPlugin
     */
    public function getSplugPlugin()
    {
        if (null === $this->slugPlugin) {
            $this->setSplugPlugin(new SlugPlugin());
        }

        return $this->slugPlugin;
    }
}
