<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Good;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CartController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/cart/", name="cart")
     * @return Response
     */
    public function cart(): Response
    {
        return $this->render('cart/cart.html.twig');
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     * @param SessionInterface $session
     * @return Response
     */
    public function add(Good $good): Response
    {
/*         if ($session->has('cart.totalQuantity')) {
             $totalQuantity = $session->get('cart.totalQuantity') + 1;
             $session->set('cart.totalQuantity', $totalQuantity);
         } else {
             $session->set('cart.totalQuantity', 1);
         }

         if ($session->has('cart.totalSum')) {
             $totalSum = $session->get('cart.totalSum') + $good[0]['price'];
             $session->set('cart.totalSum', $totalSum);
         } else {
             $session->set('cart.totalSum', $good[0]['price']);
         }*/

        //dump($session);
        //$session->clear();
        //die;

        $cart = new Cart;
        $cart->addToCart($good, $this->session);

        return $this->render('cart/cart.html.twig', ['session' => $this->session]);
    }

    /**
     * @Route("/cart/clear", name="cart_clear")
     * @param SessionInterface $session
     * @return Response
     */
    public function clearCart(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute('cart');
    }
}
