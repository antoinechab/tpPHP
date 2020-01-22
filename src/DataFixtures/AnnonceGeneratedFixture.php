<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;

class AnnonceGeneratedFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {

            $annonce = new Annonce();
            $annonce->setTitle($faker->title);
            $annonce->setContent($faker->text);
            $annonce->setPrice($faker->randomNumber(2));
        }

        $manager->persist($annonce);
        $manager->flush();
    }
}
