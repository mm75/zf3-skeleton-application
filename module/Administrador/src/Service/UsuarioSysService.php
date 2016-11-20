<?php

namespace Administrador\Service;

/**
 * Service responsável por armazenar as regras de negócio.
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
use \Doctrine\ORM\EntityManager;

/**
 * Service responsável por armazenar as regras de negócio.
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
class UsuarioSysService
{

    /**
     * @var EntityManager 
     */
    private $entityManager = null;

    /**
     * Método construtor do service.
     * 
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

}
