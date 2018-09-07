<?php
/**
 * Configuration for ModulusCore module
 */

namespace ModulusCore;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controller_plugins' => [
        'factories' => [
            'cookie' => Factory\CookieFactory::class
        ]
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [dirname(__DIR__) . '/src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
];
