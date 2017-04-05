<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/{name}")
     * @param $name
     * @return Response
     */
    public function indexAction($name)
    {
        return new Response("Nuevo bundle con Symfony 3: {$name}");
    }
}