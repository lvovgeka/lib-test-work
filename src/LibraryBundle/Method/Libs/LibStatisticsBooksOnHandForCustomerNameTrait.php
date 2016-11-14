<?php

namespace Lv\LibraryBundle\Method\Libs;


use Lv\LibraryBundle\Entity\Customer;
use Symfony\Component\DependencyInjection\ContainerInterface;

trait LibStatisticsBooksOnHandForCustomerNameTrait{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * select from db statistic by alias
     *
     * @param $alias
     * @param $customerName
     * @return mixed
     */
    public function searchCustomerByCityAliasAndCustomerName($alias, $customerName)
    {
        $customerRp = $this->container
            ->get('doctrine.orm.default_entity_manager')
            ->getRepository('LvLibraryBundle:Customer');

        $customers = $customerRp->createQueryBuilder('customer')
            ->andWhere('MATCH(customer.firstName, customer.lastName, customer.middleName) AGAINST (:customerName) > 0')
            ->setParameter('customerName', $customerName)
            ->leftJoin('customer.library', 'library')
            ->addSelect('library')
            ->leftJoin('library.city', 'city')
            ->andWhere('city.alias = :cityAlias')
            ->setParameter('cityAlias', $alias)
            ->getQuery()
            ->execute();

        if(count($customers) > 0){
            $res = [];
            $customerBooksRp = $this->container
                ->get('doctrine.orm.default_entity_manager')
                ->getRepository('LvLibraryBundle:CustomerBooks');
            foreach ($customers as $customer){
                $countCustomerBooksOnHand = $customerBooksRp->createQueryBuilder('customerBooks')
                    ->select('COUNT(customerBooks.id)')
                    ->andWhere('customerBooks.customer = :customer')
                    ->andWhere('customerBooks.readedAt IS NULL')
                    ->setParameter('customer', $customer)
                    ->getQuery()
                    ->getSingleScalarResult();

                $res[] = [
                    'lib' => $customer->getLibrary()->getName(),
                    'customer' => $customer->getName(),
                    'countBookOnHand' => $countCustomerBooksOnHand
                ];
            }
            /* @var Customer $customer */
            return $res;
        }

        return 'Not found customers';
    }
}