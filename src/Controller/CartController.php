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
     * @param Good $good
     * @return Response
     */
    public function add(Good $good): Response
    {
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
