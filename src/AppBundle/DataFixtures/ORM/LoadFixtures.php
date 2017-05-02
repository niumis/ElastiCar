<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Fuel;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFixtures implements FixtureInterface
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fuel1 = new Fuel();
        $fuel1->setTitle('Dyzelinas');
        $manager->persist($fuel1);

        $fuel2 = new Fuel();
        $fuel2->setTitle('Benzinas');
        $manager->persist($fuel2);

        $fuel3 = new Fuel();
        $fuel3->setTitle('Benzinas/Dujos');
        $manager->persist($fuel3);

        $fuel4 = new Fuel();
        $fuel4->setTitle('Benzinas/Elektra');
        $manager->persist($fuel4);

        $fuel5 = new Fuel();
        $fuel5->setTitle('Elektra');
        $manager->persist($fuel5);

        $fuel6 = new Fuel();
        $fuel6->setTitle('Dyzelinas/Dujos');
        $manager->persist($fuel6);

        $fuel7 = new Fuel();
        $fuel7->setTitle('Dyzelinas/Elektra');
        $manager->persist($fuel7);

        $fuel8 = new Fuel();
        $fuel8->setTitle('Bioetanolis (E85)');
        $manager->persist($fuel8);

        $fuel9 = new Fuel();
        $fuel9->setTitle('Kita');
        $manager->persist($fuel9);


        $manager->flush();
    }
}
