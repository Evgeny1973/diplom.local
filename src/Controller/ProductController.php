<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Good;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", name="product_id")
     */
    public function index($id)
    {
        $good = $this->getDoctrine()->getRepository(Good::class)
            ->find($id);
        if (!$good) {
            return $this->redirectToRoute('index');
        }
        $categories = $this->getDoctrine()->getRepository(Categories::class)->find($id);
        return $this->render('product/index.html.twig', ['good' => $good, 'categories' => $categories]);
    }
}
