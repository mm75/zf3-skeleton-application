<?php

namespace Administrador\Service\Factory;

/**
 * Classe responsável por criar a instância do service.
 * Injeta as dependências necessárias para a instanciação do service.
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
use \Administrador\Entity\UsuarioSys;
use \Administrador\Service\UsuarioSysService;
use \Doctrine\ORM\EntityManager;
use \Exception;
use \Interop\Container\ContainerInterface;
use \Interop\Container\Exception\ContainerException;
use \Zend\ServiceManager\Exception\ServiceNotCreatedException;
use \Zend\ServiceManager\Exception\ServiceNotFoundException;
use \Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Classe responsável por criar a instância do service.
 * Injeta as dependências necessárias para a instanciação do service.
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
class UsuarioSysServiceFactory implements FactoryInterface
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
            $entityManager = $container->get(EntityManager::class);
            $repository = $entityManager->getRepository(UsuarioSys::class);

            return new UsuarioSysService($entityManager, $repository);
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
