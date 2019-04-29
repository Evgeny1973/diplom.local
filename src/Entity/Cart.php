<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{

    public function addToCart(Good $good, SessionInterface $session): void
    {
        $cart = $session->get('cart');

        if (isset($cart[$good->getId()])) {
            $cart[$good->getId()]['goodQuantity'] += 1;
        } else {
            $cart[$good->getId()] = [

                    'id'         => $good->getId(),
                    'name'         => $good->getName(),
                    'img'          => $good->getImg(),
                    'price'        => $good->getPrice(),
                    'goodQuantity' => 1,

            ];
        }
        $session->set('cart', $cart);

        $cartTotalQuantity = $session->get('cartTotalQuantity') ? $session->get('cartTotalQuantity') + 1 : 1;
        $session->set('cart.totalQuantity', $cartTotalQuantity);

        $cartTotalSum = $session->get('cartTotalSum') ? $session->get('cartTotalSum') + $good->getPrice() : $good->getPrice();
        $session->set('cart.totalSum', $cartTotalSum);
    }
}
