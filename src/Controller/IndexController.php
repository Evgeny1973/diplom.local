<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Good;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $goods = $this->getDoctrine()->getRepository(Good::class)
            ->findLatest();
        if (!$goods){
            return $this->redirect('index');
        }
        return $this->render('index/index.html.twig', ['goods' => $goods]);
    }
}
