<?php

namespace App\Controller;

use App\Entity\Good;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function  index()
    {
        $em = $this->getDoctrine()->getRepository(Good::class);
        $goods = $em->findAll();
        return $this->render('index/index.html.twig', ['goods' => $goods]);
    }
}
