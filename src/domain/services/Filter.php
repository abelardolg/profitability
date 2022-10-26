<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class Filter extends Task
{
    public function execute(array $projects): array {

        if (empty($projects)) return parent::execute([]);

        $bestSuccessors = [];

        forEach($projects as $project) {
            $bestSuccessor = [];
            if (array_key_exists("successors", $project)) {
                $bestSuccessor = $this->getBestSuccessor(
                    $project["rootProject"]["profitability"],
                    $project["successors"]
                )
                ;
                $successorProfitability = !empty($bestSuccessor)
                    ? $bestSuccessor["profitability"]
                    : 0
                ;
                $bestSuccessor = [
                    "rootProject" => $project["rootProject"],
                    "successor" => $bestSuccessor,
                    "maximumProfitability" => $project["rootProject"]["profitability"] +
                                            $successorProfitability
                ];

            }
            $bestSuccessors[] = $bestSuccessor;
        }

        return parent::execute($bestSuccessors);
    }

    private function getBestSuccessor(int $rootProfitability, array $successors): array
    {
        $maxProfitability = 0; $bestSuccessor = [];
        forEach($successors as $successor) {
            if ($successor["profitability"] > $maxProfitability) {
                $maxProfitability = $successor["profitability"] + $rootProfitability;
                $bestSuccessor = $successor;
            }
        }
        return $bestSuccessor;
    }
}