<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Scheduling\Application\Identity;
use Freyr\Panda\QA\Scheduling\Core\Target\Target;
use Freyr\Panda\QA\Tests\Scheduling\Core\JobId;

class Item
{

    public function __construct(
        public readonly Identity $id,
        public readonly JobId $jobId,
        public readonly Target $target,
        public readonly int $priority,
        private ItemState $state,
    ) {
    }

    public function canBeExecuted(): bool
    {
        return $this->state === ItemState::CREATED;

    }

    public function execute(): void
    {
        $this->state = ItemState::IN_PROGRESS;
    }

    public function serialise(): string
    {
        return json_encode($this);
    }
}