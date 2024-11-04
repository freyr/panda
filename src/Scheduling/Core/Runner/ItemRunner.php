<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Runner;

use Freyr\Panda\QA\Scheduling\Core\Order\Item;

interface ItemRunner
{
    public function run(Item ...$job): void;
}