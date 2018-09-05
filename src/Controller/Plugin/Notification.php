<?php

namespace ModulusCore\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\Plugin\FlashMessenger as PluginFlashMessenger;

/**
 * Notification
 *
 * @category ModulusCore
 * @package Controller\Plugin
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class Notification extends AbstractPlugin
{
    public function __construct()
    {
    }
    protected $flashMessenger = null;

    /**
     * Set flashMessenger
     *
     * @param $flashMessenger
     * @return $this
     */
    public function setFlashMessenger($flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;
        $this->flashMessenger->setNamespace('Notification');
        return $this;
    }

    /**
     * Set flashMessenger
     *
     * @return Notification
     */
    public function getFlashMessenger()
    {
        if (! $this->flashMessenger instanceof PluginFlashMessenger) {
            $this->setFlashMessenger($this->getController()->flashMessenger());
        }
        return $this->flashMessenger->setNamespace('Notification');
    }

    /**
     * Get html
     *
     * @param $type
     * @param $message
     * @return string
     */
    protected function getHtml($type, $message)
    {
        $html = "<script>" . PHP_EOL;
        $html .= "$(document).ready(function() {" . PHP_EOL;
        $html .= "
            $.toast({
                text: '$message',
                showHideTransition: 'slide',
                hideAfter: false,
                icon: '$type',
                allowToastClose: false,
                loaderBg: '#fff',
                position: 'top-right'
            });
        " . PHP_EOL;
        $html .= "});" . PHP_EOL;
        $html .= "</script>" . PHP_EOL;

        return $html;
    }

    /**
     * Notification success
     *
     * @param $message
     */
    public function success($message)
    {
        $this->getFlashMessenger()->addMessage($this->getHtml('success', $message));
    }

    /**
     * Notification error
     *
     * @param $message
     */
    public function error($message)
    {
        $this->getFlashMessenger()->addMessage($this->getHtml('error', $message));
    }

    /**
     * Notification warning
     *
     * @param $message
     */
    public function warning($message)
    {
        $this->getFlashMessenger()->addMessage($this->getHtml('warning', $message));
    }

    /**
     * Notification info
     *
     * @param $message
     */
    public function info($message)
    {
        $this->getFlashMessenger()->addMessage($this->getHtml('info', $message));
    }
}
