<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

interface OrderRepository
{
    public function persist(Order $order): void;
}