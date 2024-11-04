<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

use Freyr\Panda\QA\Scheduling\Application\OrderService;
use Freyr\Panda\QA\Scheduling\Core\Order\NewOrder;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderFactory;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderRepository;

final readonly class CreateOrder implements OrderService
{

    public function __construct(
        private OrderRepository $repository,
        private OrderFactory $orderFactory,
    )
    {

    }

    public function __invoke(NewOrder $newOrder): void
    {
        $order = $this->orderFactory->new($newOrder);
        $this->repository->persist($order);
    }

    public function createOrder(NewOrder $order): void
    {
        $this($order);
    }
}