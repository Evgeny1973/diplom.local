<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Good;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $goods = $this->getDoctrine()->getRepository(Good::class)
            ->findLatest();
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        return $this->render('index/index.html.twig', ['goods' => $goods, 'categories' => $categories]);
    }
}
