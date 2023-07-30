<?php

namespace App\Controller;

use App\Message\Command\SaveOrder;
use App\Message\PurchaseConfirmationNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class StockTransactionController extends AbstractController
{
    #[Route('buy', name: 'buy-stock')]
    public function buy(MessageBusInterface $bus): Response
    {
//        $order = new class {
//            public function getId(): string
//            {
//                return 1;
//            }
//            public function getBuyer(): object
//            {
//
//                return new class {
//
//                    public function getEmail(): string
//                    {
//                        return 'email@stub.com';
//                    }
//
//                    public function getId(): string
//                    {
//                        return 1;
//                    }
//                };
//            }
//        };

        $bus->dispatch(new SaveOrder());

        return $this->render('stocks/example.html.twig');
    }
}
