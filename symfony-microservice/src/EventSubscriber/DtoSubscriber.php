<?php

namespace App\EventSubscriber;

use App\Event\AfterDtoCreatedEvent;
use App\Service\ServiceException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoSubscriber implements EventSubscriberInterface
{

    public function __construct(protected ValidatorInterface $validator)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
          AfterDtoCreatedEvent::NAME => [
              'validateDto', 100
          ],
        ];
    }

    public function validateDto(AfterDtoCreatedEvent $event): void
    {
        $dto = $event->getDot();

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            throw new ServiceException(Response::HTTP_UNPROCESSABLE_ENTITY, 'Validation failed.');
        }

    }
}
