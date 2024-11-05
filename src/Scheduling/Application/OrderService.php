<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Application;

use Freyr\Panda\QA\Scheduling\Core\Order\NewOrder;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderId;

interface OrderService
{
    public function createOrder(NewOrder $order): void;

    public function executeOrder(OrderId $orderId);
}