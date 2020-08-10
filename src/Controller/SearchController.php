<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/search", name="search_")
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/", name="search")
     */
    public function index()
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
    /**
     * @Route("/result", name="result")
     */
    public function search(Request $request, PostRepository $postRepository){
        $query = $request->request->get('search');
        if ($query){
            $posts = $postRepository->findByExampleField($query);
        }
        if (!empty($posts)) {
            return $this->render('search/result.html.twig',[
                'posts' => $posts
            ]);
        } else{
            return $this->render('search/result.html.twig',[
                'posts' => []
            ]);
        }
    }
}
