<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class SorterByProfitability extends Task
{
    public function execute(array $projects): array {
        if (!empty($projects)) {
            usort($projects, array($this, "sortByProfitability"));
        }
        return $projects[0];
    }

    private function sortByProfitability ($projectA, $projectB): int {
        if ($projectA["profitability"] === $projectB["profitability"]) {
            return 0;
        }

        if ($projectA["profitability"] > $projectB["profitability"]) {
            return -1;
        }

        return 1;
    }
}