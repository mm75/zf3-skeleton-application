<?php

namespace Administrador\Controller\Factory;

use \Administrador\Controller\UsuariosysController;
use \Administrador\Service\UsuarioSysService;
use \Interop\Container\ContainerInterface;
use \JMS\Serializer\SerializerBuilder;
use \Zend\ServiceManager\Factory\FactoryInterface;

class UsuariosysControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $serializer = SerializerBuilder::create()->build();
        $service = $container->get(UsuarioSysService::class);

        return new UsuariosysController($service, $serializer);
    }

}
