<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

use Freyr\Panda\QA\Scheduling\Core\Order\ItemState;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;
use Freyr\Panda\QA\Tests\Scheduling\Core\JobId;

class Job
{

    public function __construct(
        public readonly JobId $id,
        public readonly TargetPolicy $targetPolicy,
        public readonly int $priority,
        public readonly ItemState $jobState
    )
    {

    }
}