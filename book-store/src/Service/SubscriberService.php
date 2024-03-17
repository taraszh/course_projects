<?php

namespace App\Service;

use App\Entity\Subscriber;
use App\Exception\SubscriberExistsException;
use App\Model\SubscriberRequest;
use App\Repository\SubscriberRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class SubscriberService
{
    public function __construct(
        private SubscriberRepository   $repository,
        private EntityManagerInterface $entityManager
    ) {

    }

    public function subscribe(SubscriberRequest $subscriberRequest)
    {
        if ($this->repository->existByEmail($subscriberRequest->getEmail())) {
            throw new SubscriberExistsException();
        }

        $subscriber = new Subscriber();
        $subscriber->setEmail($subscriberRequest->getEmail());

        $this->entityManager->persist($subscriberRequest);
        $this->entityManager->flush();
    }

}
