<?php

namespace App\Service;

use App\Entity\Orders;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailService
{
    private $mailer;

     public function __construct()
     {
         $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
             ->setUsername('sushiki@inbox.ru')->setPassword('W$9N~kqRB5G4');
         $this->mailer = new Swift_Mailer($transport);
     }

    public function sendEmail(Orders $order): void
    {
        $message = (new Swift_Message)
            ->setSubject('Ваш заказ')
            ->setTo([$order->getEmail() => $order->getName(), 'benjaminmclin2@gmail.com' => 'Администратору'])
            ->setFrom('sushiki@inbox.ru', 'Магазин гаджетов')
            ->setBody('Ваш заказ принят.');
        $this->mailer->send($message);
    }
}
