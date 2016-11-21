<?php

namespace Administrador\Controller;

/**
 * Classe responsável pelo controller.
 * Disponibiliza as opções de CRUD via API REST.
 * 
 * No construtor do mesmo é injetado o serviço para manipulação dos dados e
 * a dependência para serializar dados em JSON/XML.
 *
 * PHP Version 5.6.0
 *
 * @category Controller
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
use \Administrador\Service\AbstractService;
use \JMS\Serializer\Serializer;
use \Zend\Mvc\Controller\AbstractRestfulController;

/**
 * Classe responsável pelo controller.
 * Disponibiliza as opções de CRUD via API REST.
 * 
 * No construtor do mesmo é injetado o serviço para manipulação dos dados e
 * a dependência para serializar dados em JSON/XML.
 *
 * PHP Version 5.6.0
 *
 * @category Controller
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
class AbstractController extends AbstractRestfulController
{

    /**
     * @var AbstractService
     */
    private $service = null;

    /**
     * @var Serializer
     */
    private $serializer = null;

    /**
     * Método construtor do controller.
     * 
     * @param AbstractService $service
     * @param Serializer $serializer
     */
    public function __construct(AbstractService $service, Serializer $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    /**
     * Método responsável por disponibilizar a listagem dos dados.
     * 
     * @return mixed
     */
    public function getList()
    {
        $listUsers = $this->service->findAll();

        $str = $this->serializer->serialize($listUsers, 'json');

        $this->response->getHeaders()->addHeaderLine('Content-Type', 'text/xml; charset=utf-8');
        $this->response->getHeaders()->addHeaderLine('Content-Type', 'application/json; charset=utf-8');
        $this->response->setContent($str);

        return $this->response;
    }

}
