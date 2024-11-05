<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

interface OrderRepository
{
    public function persist(Order $order): void;

    public function getById(OrderId $id): Order;
}