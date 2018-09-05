<?php
/**
 * Configuration for ModulusCore module
 */

namespace ModulusCore;

return [
    'controller_plugins' => [
        'factories' => [
            'cookie' => Factory\CookieFactory::class
        ]
    ],
];