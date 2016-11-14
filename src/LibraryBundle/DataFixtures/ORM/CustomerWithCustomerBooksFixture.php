<?php

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Lv\LibraryBundle\Entity\Customer;
use Lv\LibraryBundle\Entity\CustomerBooks;


class CustomerWithCustomerBooksFixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->generateCustomers($manager, 2);

    }

    private function generateCustomers(ObjectManager $manager, $countCostumers = 10){

        $faker = Faker\Factory::create('ru_RU');

        $libs = $manager->getRepository('LvLibraryBundle:Library')->findAll();

        for($c = 0; $c < $countCostumers; $c++)
            foreach($libs as $lib){
                $customer = new Customer();
                $customer->setFirstName($faker->firstName);
                $customer->setLastName($faker->lastName);
                $customer->setMiddleName($faker->middleNameFemale);
                $customer->setLibrary($lib);

                $manager->persist($customer);
                $manager->flush();

                foreach ($lib->getBooks() as $book){
                    if(mt_rand(0,1)){
                        continue;
                    }
                    $customerBook = new CustomerBooks();
                    $customerBook->setLibBook($book);
                    $customerBook->setCustomer($customer);
                    if(mt_rand(0,1)){
                        $customerBook->setReadedAt(new \DateTime());
                    }
                    $customerBook->setCreatedAt(
                        (new \DateTime())->sub(new DateInterval('P' . mt_rand(0,30) . 'D'))
                    );
                    $manager->persist($customerBook);
                }

                $manager->flush();
            }
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}