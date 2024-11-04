<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Application;

use Freyr\Panda\QA\Scheduling\Core\Order\NewOrder;

interface OrderService
{
    public function createOrder(NewOrder $order): void;
}