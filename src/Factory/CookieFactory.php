<?php

namespace ModulusCore\Factory;

use Interop\Container\ContainerInterface;
use ModulusCore\Controller\Plugin\Cookie;

class CookieFactory
{
    /**
     * Factory cookie plugin
     *
     * @param ContainerInterface $container
     * @return Cookie
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        $request  = $container->get('Request');
        $response = $container->get('Response');

        return new Cookie($request, $response);
    }
}
