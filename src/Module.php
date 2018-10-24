<?php

declare(strict_types=1);

namespace ModulusCore;

use ModulusCore\Factory\MailFactory;
use ModulusCore\Mail\Mail;
use ModulusCore\Services\Factory\IuguServiceFactory;
use ModulusCore\Services\IuguService;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Get services config
     *
     * @return array
     */
    public function getServiceConfig() : array
    {
        return [
            'factories' => [
                Mail::class => MailFactory::class,

                // Services
                IuguService::class => IuguServiceFactory::class
            ],
        ];
    }
}