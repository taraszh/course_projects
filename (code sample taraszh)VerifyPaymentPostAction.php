<?php

namespace App\Presentation\Api\Controller\Apple;

use ...

class VerifyPaymentPostAction extends AbstractApiController
{
    use SecurityAwareTrait;

    private AppleService $appleService;
    private AppleReceiptRepository $receiptRepository;
    private AppleOrderService $appleOrderService;
    private AppleValidator $appleValidator;

    public function __construct(
        LoggerInterface              $logger,
        Security                     $security,
        ValidatorInterface           $validator,
        RequestStack                 $requestStack,
        EventDispatcherInterface     $eventDispatcher,
        UserRepository               $userRepository,
        AppleService                 $appleService,
        AppleReceiptRepository       $receiptRepository,
        AppleOrderService            $appleOrderService,
        AppleValidator               $appleValidator
    ) {
        parent::__construct(
            $logger,
            $security,
            $validator,
            $requestStack,
            $eventDispatcher,
            $userRepository,
        );

        $this->appleService      = $appleService;
        $this->receiptRepository = $receiptRepository;
        $this->appleOrderService = $appleOrderService;
        $this->appleValidator    = $appleValidator;
    }

    /**
     * @param Request      $request
     * @param AppleReceipt $data
     *
     * @return JsonResponse
     * @throws UserNotFoundException
     * @throws NonUniqueResultException|GuzzleException
     */
    public function __invoke(Request $request, $data): JsonResponse
    {
        $response = fn(string $status, string $message) => ['status' => $status, 'message' => $message];

        if (!$this->isRequestParamsValid($data)) {
            $this->logger->error('Invalid request parameters', ['file' => __FILE__, 'context' => json_encode($data)]);

            return new JsonResponse($response('error', 'Invalid request parameters'), Response::HTTP_BAD_REQUEST);
        }

        $verificationResponse = $this->appleService->sendVerifyRequest($data->getInitialReceipt(), $data->getPassword());

        $data->setUser($this->getAuthenticatedUser());

        try {
            $this->appleValidator->checkReceipt($verificationResponse);
            $this->appleService->prepareReceipt($verificationResponse, $data);
            $this->appleOrderService->handleAppleOrder($data);
        } catch (\Exception $exception) {
            $this->sendSlackNotificationAboutException($exception, $data);

            return new JsonResponse($response('error', $exception->getMessage()));
        }

        $this->appleService->save($data);

        return new JsonResponse($response('success', 'Order created/updated'));
    }

    /**
     * todo: validate with framework
     *
     * @param AppleReceipt $receipt
     *
     * @return bool
     */
    private function isRequestParamsValid(AppleReceipt $receipt): bool
    {
        if (is_null($receipt->getPassword()) || is_null($receipt->getInitialReceipt())) {
            return false;
        }

        if ($this->receiptRepository->count(['initialReceipt' => $receipt->getInitialReceipt()])) {
            return false;
        }

        return true;
    }

    private function sendSlackNotificationAboutException(\Exception $exception, AppleReceipt $data): void
    {
        $errorInfo = [
            'message'                => $exception->getMessage(),
            'trace'                  => $exception->getTraceAsString(),
            'apple_initial_receipt'  => $data->getInitialReceipt()
        ];

        SlackHelper::sendNotificationErrorMessage(AppleValidator::RECEIPT_ERROR, json_encode($errorInfo));
    }
}
