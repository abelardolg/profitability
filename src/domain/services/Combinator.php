<?php

declare(strict_types=1);

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class Combinator extends Task {

    public function execute(array $projects): array {

        if (empty($projects)) return parent::execute([]);

        $combinations = [];

        forEach($projects as $rootProject) {
            $rootProject["successors"] = $this->getProjectsThatRunsAfterOfThisDate($rootProject, $projects);
            $combinations[$rootProject["id"]] = $rootProject;
        }

//        var_dump($combinations);

        return parent::execute($combinations);
    }

    private function getProjectsThatRunsAfterOfThisDate(array $rootProject, array $projects): array
    {
        $projectsAfterOfThisDate = [];

        forEach($projects as $project) {
            if ($project["id"] !== $rootProject["id"] &&
                $project["startDate"] >= $rootProject["endDate"]
            ) {
                $projectsAfterOfThisDate[] = $project["id"];
            }
        }

        return $projectsAfterOfThisDate;
    }

}