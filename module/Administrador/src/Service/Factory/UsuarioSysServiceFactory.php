<?php

namespace Administrador\Service\Factory;

use \Administrador\Service\UsuarioSysService;
use \Doctrine\ORM\EntityManager;
use \Interop\Container\ContainerInterface;
use \Zend\ServiceManager\Factory\FactoryInterface;

class UsuarioSysServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new UsuarioSysService($container->get(EntityManager::class));
    }

}
