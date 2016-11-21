<?php

namespace Administrador\Entity;

/**
 * Classe responsável entidade "UsuarioSys".
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
 * Classe responsável entidade "UsuarioSys".
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
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="usuario", type="string", length=10, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     * 
     * @ORM\Column(name="nome", type="string", length=50, nullable=true)
     */
    private $nome;

    /**
     * @var string
     * 
     * @ORM\Column(name="senha", type="string", length=100, nullable=true)
     */
    private $senha;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="ativo", type="boolean", nullable=true)
     */
    private $ativo;

    public function getId()
    {
        return $this->id;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }

}
