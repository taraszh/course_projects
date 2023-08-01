<?php

namespace App\MessageHandler\Event;

use App\Message\Event\OrderSavedEvent;
use App\Message\PurchaseConfirmationNotification;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;

class OrderSavedEventHandler implements MessageHandlerInterface
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(OrderSavedEvent $event)
    {
        $orderId = $event->getOrderId();

        $mdpf = new Mpdf();
        $content = "<h1>Contract note for order {$orderId}</h1>";
        $content .= '<p>Total: $432</p>';

        $mdpf->writeHtml($content);
        $contractNotePdf = $mdpf->output(dest: Destination::STRING_RETURN);

        $email = new Email();
        $email->from('sales@stocksapp.com');
        $email->to('email@example.com');
        $email->subject('Contract note for order ' . $orderId);
        $email->text('Here is your contract note');
        $email->attach($contractNotePdf);

        $this->mailer->send($email);
    }
}
