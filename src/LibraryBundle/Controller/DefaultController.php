<?php

namespace Lv\LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('LvLibraryBundle:Default:index.html.twig');
    }
}
