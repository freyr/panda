<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Application;

use Freyr\Panda\QA\Scheduling\Core\Order\OrderId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{
    public function execute(
        Request $request,
        Response $response,
        OrderService $service
    ): Response
    {
        $orderId = $request->query->get('orderId');
        $service->executeOrder(OrderId::fromString($orderId));
        return $response->setStatusCode(202);
    }
}