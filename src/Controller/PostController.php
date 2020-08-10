<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post_")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @Route("/", name="browse")
     */
    public function index(PostRepository $postRepository)
    {
        $getAllPosts = $postRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $getAllPosts,
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        if($request->getMethod() == 'POST'){

            $title = $request->request->get('title');
            $content = $request->request->get('content');

            $post = new Post();
            $post->setTitle($title);
            $post->setContent($content);

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_browse');
        }

        return $this->render('post/add.html.twig');
    }

    /**
     * @Route("/{id}", name="read", requirements={"id" = "\d+"})
     */
    public function read(Post $post, PostRepository $postRepository)
    {

        return $this->render('post/read.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Post $post, EntityManagerInterface $em, Request $request)
    {

        if($request->getMethod() == 'POST'){

            $title = $request->request->get('title');
            $body = $request->request->get('content');

            $post->setTitle($title);
            $post->setContent($body);

            // $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_browse');
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Post $post, EntityManagerInterface $em)
    {
        $em->remove($post);

        $em->flush();

        return $this->redirectToRoute('post_browse');
    }


}
