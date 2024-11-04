<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

enum ItemState: string
{
    case CREATED = 'created';
    case IN_PROGRESS = 'inprogress';
    case FINISHED = 'finished';
}