<?php

namespace Administrador;

use \Administrador\Controller\UsuariosysController;
use \Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'administrador' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/administrador/[:controller[/:id]]',
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ]
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            UsuariosysController::class => InvokableFactory::class,
        ]
    ]
];
