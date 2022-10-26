<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class Filter extends Task
{
    public function execute(array $projects): array {
        echo("filter\n");
        $bestSuccessors = [];
        forEach($projects as $project) {
            var_dump($project["rootProject"]["name"]);
            $bestSuccessor = [
                "rootProject" => $project
            ];
            if (array_key_exists("successors", $project))
                $bestSuccessor["successor"][] = $this->getBestSuccessor(
                    $project["rootProject"]["profitability"],
                    $project["successors"]
                );
//            $bestSuccessors[] = [
//                "ancestor" => $ancestor,
//                "successor" => $this->getBestSuccessor($ancestor["successors"])
//            ];
            $bestSuccessors[] = $bestSuccessor;
        }
        return parent::execute($bestSuccessors);
    }

    private function getBestSuccessor(int $rootProfitability, array $successors): array
    {
        $maxProfitability = 0; $bestSuccessor = null;
        forEach($successors as $successor) {
            if ($successor["profitability"] > $maxProfitability) {
                $maxProfitability = $successor["profitability"] + $rootProfitability;
                $bestSuccessor = $successor;
            }
        }
        var_dump($bestSuccessor);
        return [$bestSuccessor];
    }
}