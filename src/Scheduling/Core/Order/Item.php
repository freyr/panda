<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Scheduling\Core\Target\Target;
use Freyr\Panda\QA\SharedKernel\Identity;

class Item
{

    public function __construct(
        public readonly Identity $id,
        public readonly Target $target
    )
    {
    }

    public function reschedule(): bool
    {
        $this->status = 'reschedule';
        return true;
    }
}