<?php

namespace App\EventSubscriber;

use App\Event\AfterDtoCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
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

        if (count($errors)) {
            throw new ValidationFailedException('Validation failed.', $errors);
        }

    }
}
