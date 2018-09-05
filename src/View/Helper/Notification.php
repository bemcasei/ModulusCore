<?php

namespace ModulusCore\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger as PluginFlashMessenger;

/**
 * Helper include notifications in views
 *
 * Dependency: jquery-toast-plugin
 *
 * @category ModulusCore
 * @package View\Helper
 * @author  William Hoffmann <williamhoffmann@outlook.com>
 */
class Notification extends AbstractHelper
{
    protected function getHtml($type, $message, $title = null)
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

    public function __invoke()
    {
        $messenger = $this->getView()->flashMessenger()->getPluginFlashMessenger();
        $namespaces = [
            PluginFlashMessenger::NAMESPACE_ERROR,
            PluginFlashMessenger::NAMESPACE_SUCCESS,
            PluginFlashMessenger::NAMESPACE_INFO,
            PluginFlashMessenger::NAMESPACE_DEFAULT,
            'Notification'
        ];

        foreach ($namespaces as $namespace) {
            $messenger->setNamespace($namespace);
            $userMsgs = array_merge($messenger->getCurrentMessages(), $messenger->getMessages());
            $messenger->clearCurrentMessages();

            foreach ($userMsgs as $msg) {
                $msgText = $msg;

                if (is_array($msg)) {
                    $msgText = $msg['message'];
                }

                if ($namespace != 'Notification') {
                    $msgText = $this->getHtml($namespace, $msgText);
                }

                echo $msgText;
            }
        }
    }
}
