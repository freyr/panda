<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Identity\Id;
use Freyr\Panda\QA\Scheduling\Application\Identity;

class OrderId extends Id implements Identity
{

    public function toBinary(): string
    {
        // TODO: Implement toBinary() method.
    }

    public function equals(Identity $identity): bool
    {
        // TODO: Implement equals() method.
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }
}