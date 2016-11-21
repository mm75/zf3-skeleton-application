<?php

namespace Administrador;

/**
 * Classe responsável pelo carregamento de todas as classes do módulo. 
 * Nela podemos encontrar os métodos onBootstrap() (chamado sempre que o módulo for chamado) e 
 * o método init() (chamado sempre que o módulo for inicializado). 
 * Também é nessa classe que podemos definir outros métodos importantes 
 * como por exemplo o getServiceConfig().
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
use \Administrador\Controller\Factory\UsuariosysControllerFactory;
use \Administrador\Controller\UsuariosysController;
use \Administrador\Service\Factory\UsuarioSysServiceFactory;
use \Administrador\Service\UsuarioSysService;
use \Zend\ModuleManager\Feature\ConfigProviderInterface;
use \Zend\ModuleManager\Feature\ControllerProviderInterface;
use \Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * Classe responsável pelo carregamento de todas as classes do módulo. 
 * Nele podemos encontrar os métodos onBootstrap() (chamado sempre que o módulo for chamado) e 
 * o método init() (chamado sempre que o módulo for inicializado). 
 * Também é nessa classe que podemos definir outros métodos importantes 
 * como por exemplo o getServiceConfig().
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
class Module implements ConfigProviderInterface, ServiceProviderInterface, ControllerProviderInterface
{

    /**
     * Método responsável por indicar o arquivo de configuração do módulo.
     * Tamabém retorna o conteúdo do arquivo de configuração, 
     * para mesclar com as configurações do aplicativo.
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Método responsável por retonar as factories dos controllers do módulo.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerConfig()
    {
        return [
            'factories' => [
                UsuariosysController::class => UsuariosysControllerFactory::class
            ]
        ];
    }

    /**
     * Método responsável por retonar as factories dos serviços do módulo.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                UsuarioSysService::class => UsuarioSysServiceFactory::class
            ]
        ];
    }

}
