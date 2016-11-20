<?php

namespace Administrador\Controller;

use \Zend\Mvc\Controller\AbstractRestfulController;
use \Zend\View\Model\JsonModel;

class UsuariosysController extends AbstractRestfulController
{

    private $service = null;

    public function __construct($service = null)
    {
        $this->service = $service;
    }

    public function getList()
    {
        return new JsonModel(parent::getList());
    }

}
