<?php

namespace Administrador\Controller;

use \JMS\Serializer\Serializer;
use \Zend\Mvc\Controller\AbstractRestfulController;
use \Zend\View\Model\JsonModel;

class UsuariosysController extends AbstractRestfulController
{

    private $service = null;

    /**
     * @var Serializer
     */
    private $serializer = null;

    public function __construct($service, Serializer $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

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
