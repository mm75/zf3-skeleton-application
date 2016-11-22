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
use \Administrador\Entity\AbstractEntity;
use \Administrador\Repository\AbstractRepository;
use \Doctrine\ORM\EntityManager;
use \Exception;

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
    public $repository = null;

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

    /**
     * Método responsável por buscar um registro pela primary key / identifier.
     *
     * @param integer $id
     * @return object|null
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Método responsável por buscar todos os registros.
     *
     * @return array
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * Método responsável por buscar os registros de acordo com os critérios.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     * @return array
     */
    public function findBy(array $criteria = [], array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Método responsável por buscar um único registro de acordo com os critérios.
     *
     * @param array $criteria
     * @param array|null $orderBy
     * @return object|null
     */
    public function findOneBy(array $criteria = [], array $orderBy = null)
    {
        return $this->repository->findOneBy($criteria, $orderBy);
    }

    /**
     * Método que irá buscar registros no banco de dados conforme critéria informado.
     * 
     * @param array $criteria
     * @param array $order
     * @param integer $pg
     * @param boolean $usaLimit
     * 
     * @return AbstractEntity
     */
    public function getByCriteria($criteria = array(), $order = '', $pg = 0, $usaLimit = true, $filtraNulos = false)
    {
        return $this->repository->getByCriteria($criteria, $order, $pg, $usaLimit, $filtraNulos);
    }

    /**
     * Método responsável por salvar um objeto.
     * 
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws Exception
     */
    public function save(AbstractEntity $entity)
    {
        try {
            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            return $entity;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
