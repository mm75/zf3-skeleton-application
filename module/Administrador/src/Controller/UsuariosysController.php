<?php

namespace Administrador\Controller;

use \Zend\Mvc\Controller\AbstractRestfulController;

class UsuariosysController extends AbstractRestfulController
{

    public function getList()
    {
        return new \Zend\View\Model\JsonModel(['1']);
    }

}
