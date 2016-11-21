<?php

namespace Administrador\Service;

/**
 * Classe responsável por armazenar as regras de negócio.
 * No construtor do mesmo é injetado a instância do EntityManager 
 * para manipulação dos dados do banco e o repository para acesso aos dados.
 * 
 * PHP Version 5.6.0
 *
 * @category Service
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
use \Administrador\Repository\AbstractRepository;
use \Doctrine\ORM\EntityManager;

/**
 * Classe responsável por armazenar as regras de negócio.
 * No construtor do mesmo é injetado a instância do EntityManager 
 * para manipulação dos dados do banco e o repository para acesso aos dados.
 * 
 * PHP Version 5.6.0
 *
 * @category Service
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
abstract class AbstractService
{

    /**
     * @var EntityManager 
     */
    private $entityManager = null;

    /**
     * @var AbstractRepository 
     */
    private $repository = null;

    /**
     * Método construtor do service.
     * 
     * @param EntityManager $entityManager
     * @param AbstractRepository $repository
     */
    public function __construct(EntityManager $entityManager, AbstractRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

}
