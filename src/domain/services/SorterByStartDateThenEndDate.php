<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class SorterByStartDateThenEndDate extends Task
{
    public function execute(array $projects): array {
        if (!empty($projects)) {
            usort($projects, array($this, "sortByStartDateThenEndDate"));
        }

        return parent::execute($projects);
    }

    private function sortByStartDateThenEndDate ($projectA, $projectB): int {
        if ($projectA["startDate"] === $projectB["startDate"]) {
            if ($projectA["endDate"] === $projectB["endDate"]) return 0;
            if ($projectA["endDate"] < $projectB["endDate"]) return -1;
            return 1;
        }

        if ($projectA["startDate"] < $projectB["startDate"]) {
            return -1;
        }

        return 1;
    }
}