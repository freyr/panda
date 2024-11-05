<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Infrastructure;


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