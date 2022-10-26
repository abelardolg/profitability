<?php

namespace Profitability\domain\services;

use Profitability\domain\abstractions\Task;

class Formatter extends Task
{
    public function execute(array $projects): array
    {
        $successor = [];
        if (!empty($projects)) {
            if (array_key_exists("name", $projects["successor"])) {
                $successor = $projects["successor"]["name"];
            }
            return [
                "from" => $projects["rootProject"]["name"],
                "to" => $successor,
                "profitability" => $projects["maximumProfitability"]
            ];
        }

        return [];
    }
}