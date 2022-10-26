<?php

declare(strict_types=1);

namespace Profitability\domain\services;

use DateTimeImmutable;
use Profitability\domain\abstractions\Handler;
use Profitability\domain\abstractions\Task;

class GeneratorCombinations extends Task {

    public function execute(array $projects): array {
        echo("generate combinations\n");
        $combinations = [];
        forEach($projects as $rootProject) {
            $combinations[] = [
                "rootProject" => $rootProject,
                "successors" => $this->getProjectsThatRunsAfterOfThisDate($rootProject, $projects)
            ];
        }

        return parent::execute($combinations);
    }

    private function getProjectsThatRunsAfterOfThisDate(array $rootProject, array $projects): array
    {
        $projectsAfterOfThisDate = [];

        forEach($projects as $project) {
            if ($project["id"] !== $rootProject["id"] &&
                $project["startDate"] >= $rootProject["endDate"]
                ) {
                $projectsAfterOfThisDate[] = $project;
            }
        }

        return $projectsAfterOfThisDate;
    }


}