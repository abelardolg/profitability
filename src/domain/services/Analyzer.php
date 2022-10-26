<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class Analyzer extends Task
{
    public function execute(array $projects): array {
        echo("generate analyzer\n");
        return $projects;
    }
}