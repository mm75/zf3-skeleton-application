<?php

namespace Administrador\Entity;

/**
 * Entidade responsável por armazenar os dados da tabela.
 *
 * PHP Version 5.6.0
 *
 * @category Entity
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
use \Doctrine\ORM\Mapping as ORM;

/**
 * Entidade responsável por armazenar os dados da tabela.
 *
 * PHP Version 5.6.0
 *
 * @category Entity
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 *
 *
 * @ORM\Table(name="usuario_sys",
 *   uniqueConstraints={@ORM\UniqueConstraint(columns={"id"})},
 *   uniqueConstraints={@ORM\UniqueConstraint(columns={"usuario"})}
 * ),
 *   indexes={@ORM\Index(columns={"usuario"})}
 * ) 
 * @ORM\Entity(repositoryClass="\Administrador\Repository\UsuarioSysRepository")
 * @ORM\HasLifecycleCallbacks
 */
class UsuarioSys
{

    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $_id;

    /**
     * @var string
     * 
     * @ORM\Column(name="usuario", type="string", length=10, nullable=false)
     */
    private $_usuario;

    /**
     * @var string
     * 
     * @ORM\Column(name="nome", type="string", length=50, nullable=true)
     */
    private $_nome;

    /**
     * @var string
     * 
     * @ORM\Column(name="senha", type="string", length=100, nullable=true)
     */
    private $_senha;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="ativo", type="boolean", nullable=true)
     */
    private $_ativo;

    public function getId()
    {
        return $this->_id;
    }

    public function getUsuario()
    {
        return $this->_usuario;
    }

    public function getNome()
    {
        return $this->_nome;
    }

    public function getSenha()
    {
        return $this->_senha;
    }

    public function getAtivo()
    {
        return $this->_ativo;
    }

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function setUsuario($usuario)
    {
        $this->_usuario = $usuario;
        return $this;
    }

    public function setNome($nome)
    {
        $this->_nome = $nome;
        return $this;
    }

    public function setSenha($senha)
    {
        $this->_senha = $senha;
        return $this;
    }

    public function setAtivo($ativo)
    {
        $this->_ativo = $ativo;
        return $this;
    }

}
