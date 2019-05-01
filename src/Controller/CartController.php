<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Good;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id"="\d+"})
     * @param Good $good
     * @param Request $request
     * @return Response
     */
    public function add(Good $good, Request $request): Response
    {
        $cart = new Cart;
        $cart->addToCart($good, $this->session);
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/cart/clear", name="cart_clear")
     * @return RedirectResponse
     */
    public function clearCart(): RedirectResponse
    {
        $this->session->clear();
        return $this->redirectToRoute('cart');
    }
}
