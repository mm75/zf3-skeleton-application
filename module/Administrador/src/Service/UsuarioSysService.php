<?php

namespace Administrador\Service;

/**
 * Service responsável por centralizar as regras de negócio.
 *
 * PHP Version 5.4.0
 *
 * @category Service
 * @package  Administrador
 * @author   Bruno Surdi <bruno@inovadora.com.br>
 * @author   Edivilson Dalacosta <edivilson@inovadora.com.br>
 * @author   Jackson Veroneze <jackson@inovadora.com.br>
 * @author   Elisabeth Koroll <elisabeth@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 */
use \Core\Interfaces\Service\IUsuarioSysService;
use \Core\Service\AbstractService;
use \Doctrine\ORM\EntityManager;

/**
 * Service responsável por centralizar as regras de negócio.
 *
 * PHP Version 5.4.0
 *
 * @category Service
 * @package  Administrador
 * @author   Bruno Surdi <bruno@inovadora.com.br>
 * @author   Edivilson Dalacosta <edivilson@inovadora.com.br>
 * @author   Jackson Veroneze <jackson@inovadora.com.br>
 * @author   Elisabeth Koroll <elisabeth@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 */
class UsuarioSysService extends AbstractService implements IUsuarioSysService
{

    /**
     * Método construtor.
     * 
     * @param EntityManager $em Entity Manager
     */
    public function __construct()
    {
        parent::__construct();
        $this->setEntity('Administrador\Entity\UsuarioSys');
    }

}
