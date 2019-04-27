<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController
{

    /**
     * @return Response
     */
    public function categories(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        return $this->render('menu/menu.html.twig', ['categories' => $categories]);
    }
}
