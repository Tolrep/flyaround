<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TestController
 * @package AppBundle\Controller
 * @Route("/test", name="test")
 */
class TestController extends Controller
{
    /**
     * @Route("/{name}", name="test1")
     * @Method({"GET", "POST"})
     */
    public function test(Request $request, $name)
    {
        return $this->render('test/test.html.twig', array(
            "name" => $name
        ));
    }

}