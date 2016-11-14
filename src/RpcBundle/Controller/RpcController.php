<?php

namespace Lv\RpcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RpcController extends Controller
{
    /**
     * @Route("/", name="rpc")
     * @Method("POST")
     */
    public function indexAction(Request $request)
    {
        /* @var Response $response */
        $response = $this->get('rpc.server.handler')->handleHttpRequest($request);

        return $response;
    }
}
