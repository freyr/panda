<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Scheduling\Application\Identity;
use Freyr\Panda\QA\Scheduling\Core\Target\Target;

class Item
{

    public function __construct(
        public readonly Identity $id,
        public readonly Target $target,
        public readonly int $priority,
        private ItemState $state,
    )
    {
    }

    public function reschedule(): bool
    {
        $this->status = 'reschedule';
        return true;
    }

    public function canBeExecuted(): bool
    {
        return $this->state === ItemState::CREATED;
    }

    public function execute()
    {
        $this->state = ItemState::IN_PROGRESS;
    }

    public function serialise(): string
    {

    }
}