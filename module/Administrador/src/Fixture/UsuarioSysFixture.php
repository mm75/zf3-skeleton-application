<?php

namespace Administrador\Fixture;

use \Administrador\Entity\UsuarioSys;
use \Doctrine\Common\DataFixtures\FixtureInterface;
use \Doctrine\Common\Persistence\ObjectManager;
use \Faker\Factory;

class UsuarioSysFixture implements FixtureInterface
{

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
