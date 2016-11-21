<?php

namespace Administrador\Fixture;

/**
 * Classe responsável por dar carga de teste na tabela.
 * Usado somente para desenvolvimento, cria dados fakes.
 *
 * PHP Version 5.6.0
 *
 * @category Fixture
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
use \Administrador\Entity\UsuarioSys;
use \Doctrine\Common\DataFixtures\FixtureInterface;
use \Doctrine\Common\Persistence\ObjectManager;
use \Faker\Factory;

/**
 * Classe responsável por dar carga de teste na tabela.
 * Usado somente para desenvolvimento, cria dados fakes.
 *
 * PHP Version 5.6.0
 *
 * @category Fixture
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
class UsuarioSysFixture implements FixtureInterface
{

    /**
     * Método responsável por criar os dados fakes.
     * 
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $usuarioSys = new UsuarioSys();
            $usuarioSys->setNome($faker->name);
            $usuarioSys->setSenha($faker->password);
            $usuarioSys->setUsuario(substr($faker->userName, 0, 10));
            $usuarioSys->setAtivo(true);

            $manager->persist($usuarioSys);
        }

        $manager->flush();
    }

}
