<?php

namespace App\MessageHandler;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class PurchaseConfirmationNotificationHandler
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(PurchaseConfirmationNotification $notification)
    {
        echo 'Creation a PDF contract note! <br>';

        echo 'Emailing contract note to ' . $notification->getOrder()->getBuyer()->getEmail() . '<br>';

        $order = $notification->getOrder();

        $email = new Email();
        $email->from('sales@stocksapp.com');
        $email->to($order->getBuyer()->getEmail());
        $email->subject('Contract note for order ' . $order->getId());
        $email->text('Here is your contract note');

        $this->mailer->send($email);
    }
}
