<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

use Freyr\Panda\QA\Scheduling\Core\Order\OrderId;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderRepository;
use Freyr\Panda\QA\Scheduling\Core\Runner\ItemRunner;

readonly class ExecuteOrder
{
    public function __construct(
        private OrderRepository $orderRepository,
        private ItemRunner $runner,
    )
    {

    }
    public function __invoke(OrderId $orderId): void
    {
        $order = $this->orderRepository->getById($orderId);
        $order->execute($this->runner);
        $this->orderRepository->persist($order);
    }
}