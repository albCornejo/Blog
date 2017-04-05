<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class PostController extends Controller
{
    /**
     * @Route("/post", name="post_list")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/post/form", name="post_form")
     */
    public function formIndex(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(\AppBundle\Form\PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('find_all_posts');
        }
        return $this->render('post/form.html.twig', ["form" => $form->createView()]);
    }
    
    
    
    
    
    /**
 * @Route("/post/update/{id}", name="update_post")
 */
public function updateAction(Request $request, $id)
{
    $post = $this->getDoctrine()->getRepository('AppBundle:Post')->find($id);

    if(!$post)
    {
        return $this->redirectToRoute('find_all_posts');
    }

    $form = $this->createForm(\AppBundle\Form\PostType::class, $post);
    $form->add('categories', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'choice_label' => 'name',
                'multiple' => TRUE
            ));
    $form->add('save', SubmitType::class, array('label' => 'Update Post'));

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();
        return $this->redirectToRoute('find_all_posts', ["id" => $id]);
    }

    return $this->render('post/form.html.twig', ["form" => $form->createView()]);
}


/**
 * @Route("/post/add", name="add_post")
 */
public function addAction(Request $request)
{
    $post = new Post();

    $form = $this->createForm(\AppBundle\Form\PostType2::class, $post);
    

    
    

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();
        return $this->redirectToRoute('find_all_posts');
    }
    return $this->render('post/form.html.twig', ["form" => $form->createView()]);
}





}