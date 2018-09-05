<?php

namespace ModulusCore\Factory;

use ModulusCore\Mail\Mail;
use Interop\Container\ContainerInterface;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class MailFactory
{
    /**
     * Factory mail
     *
     * @param ContainerInterface $container
     * @return Mail
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $transport = new SmtpTransport();
        $options = new SmtpOptions($config['mail']);
        $transport->setOptions($options);
        $view = $container->get('View');

        return new Mail($transport, $view);
    }
}
