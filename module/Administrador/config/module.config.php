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
        ],
        'invokables' => [
            'usuariosys' => Controller\UsuariosysController::class
        ]
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],
    'doctrine' => [
        'driver' => [
            'application_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Administrador\UsuarioSys' => 'application_driver'
                ]
            ]
        ],
        'fixtures' => [
            'UsuarioSysFixture' => __DIR__ . '/../src/Fixture'
        ]
    ]
];
