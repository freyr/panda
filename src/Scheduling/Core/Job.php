<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

use Freyr\Panda\QA\Scheduling\Core\Order\ItemState;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;

class Job
{

    readonly public TargetPolicy $targetPolicy;
    public readonly int $priority;
    private ItemState $jobState;
}