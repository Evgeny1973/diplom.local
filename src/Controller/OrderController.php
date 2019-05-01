<?php

namespace App\Controller;

use App\Entity\OrderGood;
use App\Entity\Orders;
use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     * @param Request $request
     * @param MailService $mailer
     * @param SessionInterface $session
     * @return Response
     * @throws \Exception
     */
    public function order(Request $request, MailService $mailer, SessionInterface $session): Response
    {
        if (!$session->has('cart.totalSum')){
           return $this->redirectToRoute('index');
        }
        $order = new Orders;
        $form = $this->createFormBuilder($order)
            ->add('name', TextType::class, ['label' => 'Ваше имя:', 'required' => true])
            ->add('email', EmailType::class, ['label' => 'Ваш email:', 'required' => true])
            ->add('phone', TextType::class, ['label' => 'Ваш телефон:', 'required' => true])
            ->add('address', TextType::class, ['label' => 'Ваш адрес:', 'required' => true])
            ->add('save', SubmitType::class, ['label' => 'Оформить'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $order = $form->getData();
            $order->setSum($session->get('cart.totalSum'))->setDate();
            $mailer->sendEmail($order);
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $session->set('currentId', $order->getId());
            $em->flush();

            $currentId = $order->getId();
            $this->saveOrderInfo($session->get('cart'), $currentId);
            $session->remove('cart.totalSum');
            return $this->render('order/thanx.html.twig', ['currentid' => $currentId]);
        }

        return $this->render('order/index.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param $goods
     * @param $currentId
     */
    protected function saveOrderInfo(array $goods, int $currentId): void
    {
        $em = $this->getDoctrine()->getManager();
        foreach ($goods as $id => $good) {
            $orderInfo = new OrderGood;
            $orderInfo->setOrderId($currentId);
            $orderInfo->setProductId($id);
            $orderInfo->setName($good['name']);
            $orderInfo->setPrice($good['price']);
            $orderInfo->setQuantity($good['goodQuantity']);
            $orderInfo->setSum($good['price'] * $good['goodQuantity']);
            $em->persist($orderInfo);
        }
        $em->flush();
    }
}
