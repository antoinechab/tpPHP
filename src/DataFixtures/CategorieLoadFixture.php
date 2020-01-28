<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieLoadFixture extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i=0;$i<25;$i++){
            $categorie = new Categorie();
            $categorie->setNom($faker->name);
            $categorie->setCouleur($faker->colorName);

            $this->addReference("cat".$i."",$categorie);

            $manager->persist($categorie);
            $manager->flush();
        }
    }


}