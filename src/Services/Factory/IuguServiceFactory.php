<?php

namespace ModulusCore\Services\Factory;

use Interop\Container\ContainerInterface;
use Iugu\Sdk\Iugu;
use ModulusCore\Services\IuguService;

class IuguServiceFactory
{
    /**
     * Factory Iugu Service
     *
     * @param ContainerInterface $container
     * @return IuguService
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['iugu_client'];
        $iuguSdk = new Iugu($config['token']);

        return new IuguService($iuguSdk);
    }
}