<?php

namespace Lv\LibraryBundle\Method\Libs;

use Symfony\Component\DependencyInjection\ContainerInterface;

trait LibBooksStatOnHandTrait{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * select from db statistic by alias
     *
     * @param $alias
     * @param $dateFrom
     * @return mixed
     */
    public function getStatByLibAlias($alias, $dateFrom)
    {
        $lib = $this->container
            ->get('doctrine.orm.default_entity_manager')
            ->getRepository('LvLibraryBundle:Library');

        $res = $lib->createQueryBuilder('library')
            ->addSelect('city')
            ->leftJoin('library.city','city')
            ->andWhere('city.alias = :cityAlias')
            ->setParameter('cityAlias', $alias)

            ->leftJoin('library.customers', 'customers')
            ->addSelect('customers')

            ->leftJoin('customers.books', 'books')
            ->addSelect('books')
            ->andWhere('books.createdAt >= :dateFrom')
            ->setParameter('dateFrom', $dateFrom)
            ->getQuery()
            ->execute();


        if(count($res) == 1){
            $res = $res[0];
        }
         return $res;
    }
}