<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post/{post}/comment", name="post_comment_", requirements={"post": "\d+"})
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function add(Post $post, Request $request)
    {

        if($request->getMethod() == 'POST'){

            $content = $request->request->get('content');

            $comment = new Comment();
            $comment->setContent($content);
            $comment->setPost($post);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('post_read', ['id' => $post->getId()]);
        }
        return $this->render('comment/add.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Comment $comment, EntityManagerInterface $em)
    {
        $em->remove($comment);

        $em->flush();

        return $this->redirectToRoute('post_read', array('id' => $comment->getPost()->getId()));
    }
}
