<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
    
    /**
 * @Route("/posts/create", name="create_post")
 */
public function createIndex()
{
    $post = new Post();
    $post->setTitle("Nuevo post");
    $post->setBody("Nuevo body");

    $em = $this->getDoctrine()->getManager();

    $em->persist($post);

    // executes the query
    $em->flush();

    return new Response('Saved new post with id '.$post->getId());
}

/**
 * @Route("/posts/update/{postId}")
 */
public function updateAction($postId)
{
    $em = $this->getDoctrine()->getManager();
    $post = $em->getRepository('AppBundle:Post')->find($postId);

    if (!$post) {
        throw $this->createNotFoundException(
            'No post found for id '.$postId
        );
    }

    $post->setTitle('Nuevo post actualizado!');
    $em->flush();

    return new Response('Updated post with id '.$post->getId());
}

/**
 * @Route("/posts/find/{postId}", name="find_post")
 */
public function findAction($postId)
{
    $post = $this->getDoctrine()->getRepository('AppBundle:Post')->find($postId);

    if(!$post)
    {
        throw $this->createNotFoundException(
            'No post found for id '.$postId
        );
    }

    return new Response(sprintf(
        "%d.- %s, %s",
        $post->getId(), $post->getTitle(), $post->getBody()
    ));
}


/**
 * @Route("/posts", name="find_all_posts")
 */
public function findAllAction()
{
    $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();

    if(!$posts)
    {
        throw $this->createNotFoundException(
            'No posts found'
        );
    }

    $response = "";
    foreach($posts as $post)
    {
        $response.=sprintf(
            "<p>%d.- %s, %s</p>",
            $post->getId(), $post->getTitle(), $post->getBody()
        );
    }

    return new Response($response);
}

/**
 * @Route("/posts/remove/{postId}", name="remove_post")
 */
public function removeAction($postId)
{
    $post = $this->getDoctrine()->getRepository('AppBundle:Post')->find($postId);

    if(!$post)
    {
        throw $this->createNotFoundException(
            'No post found for id '.$postId
        );
    }

    $em = $this->getDoctrine()->getManager();
    $em->remove($post);
    $em->flush();

    return new Response("The post with id {$postId} has been removed");
}


/**
 * @Route("/posts/dql", name="dql_post")
 */
public function dqlAction()
{
    $title = "Nuevo post 2";
    $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findOneByTitle($title);

    if(!$post)
    {
        throw $this->createNotFoundException(
            'No post found for title ' . $title
        );
    }

    return new Response(sprintf(
        "%d.- %s, %s",
        $post->getId(), $post->getTitle(), $post->getBody()
    ));
}

}
