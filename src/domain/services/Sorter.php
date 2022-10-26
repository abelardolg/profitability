<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class Sorter extends Task
{
    public function execute(array $projects): array {
        if (!empty($projects)) {
            usort($projects, array($this, "compare"));
        }

        return parent::execute($projects);
    }

    private function compare ($projectA, $projectB): int {
        if ($projectA["startDate"] === $projectB["startDate"]) {
            return 0;
        }

        return ($projectA["startDate"] < $projectB["startDate"])
                ? -1
                : 1
        ;
    }
}