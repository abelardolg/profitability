<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class Formatter extends Task
{
    public function execute(array $projects): array {
        return [
            "from" => $projects["rootProject"]["name"],
            "to" => $projects["successor"]["name"],
            "profitability" => $projects["maximumProfitability"]
        ];
    }
}