<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class AnnonceGeneratedFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i <= 10; $i++) {

            $annonce = new Annonce();
            $annonce->setCategorie($this->getReference("cat".$i.""));
            $annonce->setTitle($faker->title);
            $annonce->setContent($faker->text);
            $annonce->setPrice($faker->randomNumber(2));
            $annonce->setCreatedAt($faker->dateTime());

            $manager->persist($annonce);
            $manager->flush();
        }
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(CategorieLoadFixture::class);
    }
}
