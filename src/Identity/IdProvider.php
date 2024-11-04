<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Identity;

use Freyr\Panda\QA\Scheduling\Application\Identity;
use Freyr\Panda\QA\Scheduling\Core\Order\IdentityProvider;

class IdProvider implements IdentityProvider
{
    public function new(): Identity
    {
        return Id::new();
    }
}