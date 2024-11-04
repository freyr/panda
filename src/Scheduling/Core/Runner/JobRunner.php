<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Runner;

use Freyr\Panda\QA\Scheduling\Core\Job;

interface JobRunner
{
    public function run(Job ...$job): void;
}