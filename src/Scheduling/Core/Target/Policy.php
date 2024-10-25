<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Target;

enum Policy: string
{
    case ANY = 'any';
    case PREFERRED = 'preferred';
    case STRICT = 'strict';
}