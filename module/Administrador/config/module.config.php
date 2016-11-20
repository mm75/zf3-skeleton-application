<?php

namespace Administrador;

use \Administrador\Controller\UsuariosysController;
use \Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use \Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'administrador' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/administrador/[:controller[/:id]]',
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'aliases' => [
            'usuariosys' => UsuariosysController::class
        ]
    ],
    'doctrine' => [
        'driver' => [
            'application_driver' => [
                'class' => AnnotationDriver::class,
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
