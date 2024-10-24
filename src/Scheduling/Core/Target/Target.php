<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Target;

enum Target: string
{
    case US = 'us';
    case PL = 'pl';
    case CA = 'ca';
}