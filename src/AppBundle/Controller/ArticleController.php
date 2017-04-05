<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    
    /**
 * @Route("/article/list")
 */
public function indexAction()
{
    return $this->render("AppBundle:Article:index.html.twig", []);
}


/**
 * @Route("/article/show/{articleId}")
 */
public function singleAction($articleId)
{
    return $this->render("@App/Article/single.html.twig", ["articleId" => $articleId]);
}


/**
 * @Route(
 *     "/article/{name}.{_format}",
 *     defaults={"_format": "html"},
 *     requirements={
 *         "_format": "html|php|json"
 *     }
 * )
 */
public function formatAction()
{
    return $this->render("@App/Article/format.html.twig");
}


/**
 * @Route("/article/slug/{slug}", name="article_by_slug")
 */
public function namedAction($slug)
{
    return $this->render("@App/Article/slug.html.twig", ["slug" => $slug]);
}
    
}