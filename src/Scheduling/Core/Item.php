<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

class Item
{

    public function __construct(
        public readonly Identity $id,
        public readonly Target $target
    )
    {
    }
}