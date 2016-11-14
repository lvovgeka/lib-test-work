<?php

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Lv\LibraryBundle\Entity\City;

class CityFixture extends AbstractFixture implements OrderedFixtureInterface, \Symfony\Component\DependencyInjection\ContainerAwareInterface
{
    use \Symfony\Component\DependencyInjection\ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        $sluglify = $this->container->get('slugify');

        foreach($this->getCities() as $cityName){

            $city = new City();
            $city->setName($cityName);
            $city->setAlias($sluglify->slugify($cityName));
            $manager->persist($city);
        }
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }

    protected function getCities(){
        return [
            'Москва',
            'Санкт-Петербург',
            'Новосибирск',
        ];
    }
}