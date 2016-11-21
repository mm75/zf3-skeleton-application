<?php

namespace Administrador\Controller\Factory;

/**
 * Classe responsável por criar a instância do controller.
 * Injeta as dependências necessárias para a instanciação do controller.
 *
 * PHP Version 5.6.0
 *
 * @category Factory
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
use \Administrador\Controller\UsuariosysController;
use \Administrador\Service\UsuarioSysService;
use \Exception;
use \Interop\Container\ContainerInterface;
use \Interop\Container\Exception\ContainerException;
use \JMS\Serializer\SerializerBuilder;
use \Zend\ServiceManager\Exception\ServiceNotCreatedException;
use \Zend\ServiceManager\Exception\ServiceNotFoundException;
use \Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Classe responsável por criar a instância do controller.
 * Injeta as dependências necessárias para a instanciação do controller.
 *
 * PHP Version 5.6.0
 *
 * @category Factory
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
class UsuariosysControllerFactory implements FactoryInterface
{

    /**
     * Método responsável por criar a instância do controller.
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        try {
            $serializer = SerializerBuilder::create()->build();
            $service = $container->get(UsuarioSysService::class);

            return new UsuariosysController($service, $serializer);
        } catch (ServiceNotFoundException $exc) {
            throw $exc;
        } catch (ServiceNotCreatedException $exc) {
            throw $exc;
        } catch (ContainerException $exc) {
            throw $exc;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
