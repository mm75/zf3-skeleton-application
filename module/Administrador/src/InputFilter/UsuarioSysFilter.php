<?php

namespace Administrador\InputFilter;

/**
 * Classe responsável por filtrar os dados de entrada.
 *
 * PHP Version 5.6.0
 *
 * @category InputFilter
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
use \Zend\Filter\Boolean;
use \Zend\Filter\StringToUpper;
use \Zend\Filter\StringTrim;
use \Zend\Filter\StripTags;
use \Zend\InputFilter\InputFilter;

/**
 * Classe responsável por filtrar os dados de entrada.
 *
 * PHP Version 5.6.0
 *
 * @category InputFilter
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
class UsuarioSysFilter extends InputFilter
{

    /**
     * Método construtor da classe.
     */
    public function __construct()
    {
        $this->add([
            'name' => 'usuario',
            'filters' => [
                    ['name' => StringToUpper::class],
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class]
            ]]
        );

        $this->add([
            'name' => 'nome',
            'filters' => [
                    ['name' => StringToUpper::class],
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class]
            ]]
        );

        $this->add([
            'name' => 'senha',
            'filters' => [
                    ['name' => StringToUpper::class],
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class]
            ]]
        );

        $this->add([
            'name' => 'ativo',
            'filters' => [
                    ['name' => Boolean::class],
            ]]
        );
    }

}
