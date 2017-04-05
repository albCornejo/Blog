<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Home:index.html.twig', array(
            "page_title" => "Listado de categorías",
            "categories" => $this->getDoctrine()->getRepository("AppBundle:Category")->findAll()
        ));
    }

}