<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class Analyzer extends Task
{
    public function execute(array $projects): array {
        echo("generate analyzer\n");
        $roadmapWithTheBestProfitability = [];
        $theBestProfitability = 0;
        forEach($projects as $project) {
            if ($project["maximumProfitability"] > $theBestProfitability) {
                $theBestProfitability = $project["maximumProfitability"];
                $roadmapWithTheBestProfitability = $project;
            }
        }

        return parent::execute($roadmapWithTheBestProfitability);
    }
}