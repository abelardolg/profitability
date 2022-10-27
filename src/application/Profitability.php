<?php

declare(strict_types=1);

namespace Profitability\application;

use Profitability\domain\exceptions\DateRangeNotAllowedException;
use Profitability\domain\exceptions\ValueNotAllowedException;

use Profitability\domain\services\SorterByStartDateThenEndDate;
use Profitability\domain\services\Combinator;
use Profitability\domain\services\GeneratorSuccessors;

use Profitability\domain\services\SorterByProfitability;

use Profitability\domain\services\Formatter;


use Profitability\infrastructure\data\ProjectDatabase;


class Profitability {

    /**
     * @throws DateRangeNotAllowedException
     * @throws ValueNotAllowedException
     */
    public function execute(): void
    {

        $projects = ProjectDatabase::getData();

        $theBestRoadmap = [];

        if (count($projects) === 1) {
            $theBestRoadmap = [
                "id" => $projects[0]["id"],
                "profitability" => $projects[0]["profitability"]
            ];
        }

        if (count($projects) > 1) {
            $sorterByStartDateThenEndDate = new SorterByStartDateThenEndDate();
            $combinator = new Combinator();
            $generatorSuccessors = new GeneratorSuccessors();
            $sorterByProfitability = new SorterByProfitability();

            $sorterByStartDateThenEndDate->linkedWith($combinator)->linkedWith($generatorSuccessors)
                ->linkedWith($sorterByProfitability);

            $theBestRoadmap = $sorterByStartDateThenEndDate->execute($projects);

        }

        if (count($theBestRoadmap) === 0) die("No projects found!");

        $this->formatter($projects, $theBestRoadmap);

    }

    private function formatter(array $projects, array $theBestRoadmap): void
    {
        $projectNamesIds = array_column($projects, "name", "id");
        $theBestProjects = explode(",", $theBestRoadmap["id"]);

        echo "The best roadmap is:\n";
        forEach($theBestProjects as $theBestProject) {
            echo $projectNamesIds[$theBestProject] . "\n";
        }
        echo "with " . $theBestRoadmap["profitability"] . "€ of profitability\n";
    }
}


