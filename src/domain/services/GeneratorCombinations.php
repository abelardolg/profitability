<?php

declare(strict_types=1);

namespace Profitability\domain\services;

use DateTimeImmutable;
use Profitability\domain\abstractions\Handler;
use Profitability\domain\abstractions\Task;

class GeneratorCombinations extends Task {

    private array $sortedProjects;

    public function execute(array $projects): array {
        $this->sortedProjects = $projects;
        echo("generate combinations\n");
        $combinations = [];
        forEach($projects as $project) {
            $combinations[] = $this->getProjectsThatRunsAfterOfThisDate($project, $project["endDate"]);
        }

        return parent::execute($combinations);
    }

    private function getProjectsThatRunsAfterOfThisDate(array $rootProject, int $endDate): array
    {
        $projectsAfterOfThisDate = [
            "rootProject" => $rootProject
        ];
        forEach($this->sortedProjects as $project) {
            $addedSuccessor = [];
            if ($project["startDate"] >= $endDate &&
                $project["id"] !== $rootProject["id"]) {
                $projectsAfterOfThisDate["successors"][] = $project;
            }

        }
        return $projectsAfterOfThisDate;
    }


}