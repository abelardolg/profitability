<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class GeneratorSuccessors extends Task
{
    public function execute(array $projects): array {

        if (empty($projects)) return parent::execute([]);

        $bestSuccessors = [];

        forEach($projects as $project) {
            $bestSuccessor = $this->getBestSuccessors(
                    $projects,
                    $project,
                    $project["successors"],
                    0
            )
            ;

            $bestSuccessors[] = $bestSuccessor;
        }

        return parent::execute($bestSuccessors);
    }

    private function getBestSuccessors(array $projects, array $rootProject, array $successors, int $posSuccessor): array
    {
        if (empty($successors)) {
            return [
                "id" => $rootProject["id"],
                "profitability" => $rootProject["profitability"]
            ];
        }

        $data = $this->getBestSuccessors(
            $projects,
            $projects[$successors[$posSuccessor]],
            $projects[$successors[$posSuccessor]]["successors"],
            $posSuccessor)
        ;
        $data["id"] = $rootProject["id"] . "," . $data["id"];
        $data["profitability"] += $rootProject["profitability"];

        return $data;
    }
}