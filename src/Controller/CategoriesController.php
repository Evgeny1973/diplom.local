<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Good;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{

    /**
     * @Route("/category/{id}", name="category_id", requirements={"id"="\d+"})
     */
    public function category($id)
    {
        $goods = $this->getDoctrine()->getRepository(Good::class)
            ->findBy(['category' => $id]);
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        return $this->render('categories/category.html.twig', ['goods' => $goods, 'categories' => $categories]);
    }
}
