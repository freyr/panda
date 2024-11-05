<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Infrastructure;

use Freyr\Panda\QA\Scheduling\Application\Identity;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderRepository;

class OrderInMemoryRepository implements OrderRepository
{
    private array $orders = [];

    public function __construct()
    {
    }

    public function persist(Order $order): void
    {
        $this->orders[(string) $order->id] = $order;
    }

    public function getById(Identity $identity): Order
    {
        return $this->orders[(string) $identity];
    }
}