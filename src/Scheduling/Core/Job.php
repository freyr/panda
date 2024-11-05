<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

use Freyr\Panda\QA\Scheduling\Core\Order\ItemState;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;

class Job
{

    public function __construct(
        public readonly TargetPolicy $targetPolicy,
        public readonly int $priority,
        public readonly ItemState $jobState
    )
    {

    }
}