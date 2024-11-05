<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Infrastructure;


use Freyr\Panda\QA\Scheduling\Core\Order\Order;

class Repository
{

    /** @return Event[] */
    protected function extractEvents(Order $aggregate): array
    {
        $eventExtractor = function (): array {
            return $this->popRecordedEvents();
        };
        return $eventExtractor->call($aggregate);
    }
}