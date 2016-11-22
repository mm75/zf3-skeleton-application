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
use \Zend\Hydrator\ClassMethods;
use \Zend\InputFilter\InputFilter;
use \Zend\Mvc\Controller\AbstractRestfulController;
use \Zend\View\Model\JsonModel;

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
     * @var InputFilter
     */
    private $inputFilter = null;

    /**
     * Método construtor do controller.
     * 
     * @param AbstractService $service
     * @param Serializer $serializer
     */
    public function __construct(AbstractService $service, Serializer $serializer, InputFilter $inputFilter)
    {
        $this->service = $service;
        $this->serializer = $serializer;
        $this->inputFilter = $inputFilter;
    }

    /**
     * Método responsável por disponibilizar a listagem dos dados.
     * 
     * @return mixed
     */
    public function getList()
    {
        $listUsers = $this->service->findAll();

        return new JsonModel($this->serializer->toArray($listUsers));
    }

    /**
     * Método responsável por criar um registro.
     * 
     * @return mixed
     */
    public function create($data)
    {
        $dataFilter = $this->inputFilter->setData($data)->getValues();

        $entityName = $this->service->repository->getClassName();

        $values = (new ClassMethods())->hydrate($dataFilter, new $entityName);

        $result = $this->service->save($values);

        return new JsonModel($this->serializer->serialize($values, 'json'));
    }

}
