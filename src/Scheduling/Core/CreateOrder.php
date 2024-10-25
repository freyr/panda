<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

final readonly class CreateOrder
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
}