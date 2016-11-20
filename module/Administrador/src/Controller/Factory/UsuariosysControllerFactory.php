<?php

namespace Administrador\Controller\Factory;

use \Administrador\Controller\UsuariosysController;
use \Administrador\Service\UsuarioSysService;
use \Interop\Container\ContainerInterface;
use \Zend\ServiceManager\Factory\FactoryInterface;

class UsuariosysControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new UsuariosysController($container->get(UsuarioSysService::class));
    }

}
