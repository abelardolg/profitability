<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class Filter extends Task
{
    public function execute(array $projects): array {
        echo("filter\n");
        $bestSuccessors = [];
        forEach($projects as $project) {
            $bestSuccessor = [];
            if (array_key_exists("successors", $project)) {
                $bestSuccessor = [
                    "rootProject" => $project["rootProject"],
                    "successor" => $this->getBestSuccessor(
                        $project["rootProject"]["profitability"],
                        $project["successors"]
                    )
                ];
            }
            $bestSuccessors[] = $bestSuccessor;

        }
        die(var_dump($bestSuccessors));
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