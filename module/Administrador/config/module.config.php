<?php

namespace Administrador;

/**
 * Arquivo responsável por toda configuração do módulo. 
 * É nele que registramos as rotas de acesso, os controllers do módulos e etc.
 *
 * PHP Version 5.6.0
 *
 * @category Structure
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
use \Administrador\Controller\UsuariosysController;
use \Administrador\Middleware\Factory\IndexMiddlewareFactory;
use \Administrador\Middleware\IndexMiddleware;
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
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'middleware' => IndexMiddleware::class,
                    ]
                ]
            ]
        ]
    ],
    'service_manager' => [
        'factories' => [
            IndexMiddleware::class => IndexMiddlewareFactory::class,
        ],
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
                    'Administrador\Entity\UsuarioSys' => 'application_driver'
                ]
            ]
        ],
        'fixtures' => [
            'UsuarioSysFixture' => __DIR__ . '/../src/Fixture'
        ]
    ]
];
