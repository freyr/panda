<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;
use Freyr\Panda\QA\SharedKernel\Identity;

interface NewOrder
{
    public function ownerId(): Identity;

    public function getPriority(): int;

    public function getOverrideTargetPolicy(): TargetPolicy;

    public function getPacketId(): Identity;

    public function getNewOrderId(): Identity;
}