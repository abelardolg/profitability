<?php

declare(strict_types=1);

namespace Profitability\domain\abstractions;

abstract class Task implements Handler
{
    private Handler $next;

    public function linkedWith(Handler $handler): Handler
    {
        $this->next = $handler;

        return $handler;
    }

    public function execute(array $projects): array
    {
        if ($this->next) {
            return $this->next->execute($projects);
        }

        return $projects;

    }
}