<?php

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Lv\LibraryBundle\Entity\Library;
use Lv\LibraryBundle\Entity\LibraryBooks;

class LibraryWithLibBooksFixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $url = 'http://testactual.local/';

        foreach(
            $manager->getRepository('LvLibraryBundle:City')
                ->findAll() as $city
        ){
            $lib = new Library();
            $lib->setName('Библиотека города ' . $city->getName());
            $lib->setCity($city);
            $lib->setUrl($url);
            foreach($manager->getRepository('LvLibraryBundle:Book')->findAll() as $book){

                $libBook = new LibraryBooks();
                $libBook->setBook($book);
                $libBook->setLibrary($lib);
                $libBook->setCount(mt_rand(5,500));
                $manager->persist($libBook);
            }
            $manager->persist($lib);
            $manager->flush();
        }
        $manager->persist($city);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}