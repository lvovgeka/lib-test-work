<?php

namespace Lv\LibraryBundle\Method\CentralizedRepository;

use Lv\LibraryBundle\Entity\Library;
use Lv\LibraryBundle\Method\BaseMethod;
use Lv\LibraryBundle\Method\Libs\LibBooksStatOnHandTrait;
use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("centralizedRepository.getStatisticsBooksOnHand")
 * @Rpc\Cache(lifetime=3600)
 */
class GetStatisticsBooksOnHand extends BaseMethod
{
    use LibBooksStatOnHandTrait;
    /**
     * @Rpc\Param()
     */
    protected $dateFrom = null;

    /**
     * @Rpc\Execute()
     */
    public function execute()
    {
        $this->dateFrom = $this->dateFrom ?: (new \DateTime())->format('Y-m-d');

        $libs = $this->container->get('doctrine.orm.default_entity_manager')
            ->getRepository('LvLibraryBundle:Library')
            ->findAll();

        $res = [];

        $rpcClient = $this->get('rpc.client.handler');

        /* @var Library $lib*/
        foreach ($libs as $lib){

            $method = 'libs.'. $lib->getCity()->getAlias() . '.getStatisticsBooksOnHand';

            $rpcRes = $rpcClient
                ->setUrl($lib->getUrl())
                ->call($method, ['dateFrom' => $this->dateFrom])
                ->resultToArray();
            $res[$lib->getCity()->getName()] = isset($rpcRes['result']) ? $rpcRes['result'] : $rpcRes;
        }

        return $res;
    }
}
