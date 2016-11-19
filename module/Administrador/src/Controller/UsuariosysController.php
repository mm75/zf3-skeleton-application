<?php

namespace Administrador\Controller;

use \Zend\Mvc\Controller\AbstractRestfulController;

class UsuariosysController extends AbstractRestfulController
{

    public function create($data)
    {
        return new \Zend\View\Model\JsonModel(parent::create($data));
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    public function get($id)
    {
        parent::get($id);
    }

    public function getList()
    {
         return new \Zend\View\Model\JsonModel(parent::getList($data));
        
        parent::getList();
    }

    public function update($id, $data)
    {
        parent::update($id, $data);
    }

}
