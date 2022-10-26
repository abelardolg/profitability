<?php

namespace Profitability\domain\services;

use Profitability\domain\concepts\Task;

class Formatter extends Task
{
    public function execute(array $projects): array {
        return $projects;
    }
}