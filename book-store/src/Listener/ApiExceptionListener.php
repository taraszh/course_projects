<?php

namespace App\Listener;

use App\Model\ErrorResponse;
use App\Service\ExceptionHandler\ExceptionMapping;
use App\Service\ExceptionHandler\ExceptionMappingResolver;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ApiExceptionListener
{
    public function __construct(
        private ExceptionMappingResolver $exceptionMappingResolver,
        private LoggerInterface          $logger,
        private SerializerInterface      $serializer,
        private bool                     $isDebug
    ) {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        $mapping = $this->exceptionMappingResolver->resolve($throwable::class);

        if (!$mapping) {
            $mapping = ExceptionMapping::fromCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($mapping->getCode() >= Response::HTTP_INTERNAL_SERVER_ERROR
            || $mapping->isLoggable()
        ) {
            $this->logger->error(
                $throwable->getMessage(),
                [
                    'trace' => $throwable->getTraceAsString(),
                    'previous' => $throwable->getPrevious()?->getMessage() ?? '',
                ]
            );
        }

        $code          = $mapping->getCode();
        $message       = $mapping->isHidden() ? Response::$statusTexts[$code] : $throwable->getMessage();
        $details       = $this->isDebug ? [$throwable->getTrace()] : null;
        $responseModel = new ErrorResponse($message, $details);
        $data          = $this->serializer->serialize($responseModel, JsonEncoder::FORMAT);

        $event->setResponse(
            new JsonResponse(
                data: $data,
                status:  $code,
                json: true
            )
        );
    }
}
