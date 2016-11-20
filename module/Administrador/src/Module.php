<?php

namespace Administrador;

use \Administrador\Controller\Factory\UsuariosysControllerFactory;
use \Administrador\Controller\UsuariosysController;
use \Administrador\Service\Factory\UsuarioSysServiceFactory;
use \Administrador\Service\UsuarioSysService;
use \Zend\ModuleManager\Feature\ConfigProviderInterface;
use \Zend\ModuleManager\Feature\ControllerProviderInterface;
use \Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface, ControllerProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                UsuariosysController::class => UsuariosysControllerFactory::class
            ]
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                UsuarioSysService::class => UsuarioSysServiceFactory::class
            ]
        ];
    }

}
