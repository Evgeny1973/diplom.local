<?php

namespace App\Controller;

use App\Entity\Good;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CartController extends AbstractController
{

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     * @param int $id
     * @param SessionInterface $session
     * @return Response
     */
    public function add(int $id, SessionInterface $session): Response
    {
        $good = $this->getDoctrine()->getRepository(Good::class)
            ->getGoodForCart($id);
        if (!$good) {
            return $this->redirectToRoute('index');
        }
        $session->set('cart', $good);

        if ($session->has('totalQuantity')) {
            $totalQuantity = $session->get('totalQuantity') + 1;
            $session->set('totalQuantity', $totalQuantity);
        } else {
            $session->set('totalQuantity', 1);
        }

        if ($session->has('totalSum')) {
            $totalSum = $session->get('totalSum') + $good[0]['price'];
            $session->set('totalSum', $totalSum);
        } else {
            $session->set('totalSum', $good[0]['price']);
        }

        //$session->clear();

        return $this->render('cart/cart.html.twig', ['session' => $session]);
    }
}
