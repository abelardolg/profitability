<?php

declare(strict_types=1);

namespace Profitability\domain\services;

use Profitability\domain\exceptions\DateRangeNotAllowedException;
use Profitability\domain\exceptions\ValueNotAllowedException;
use Profitability\infrastructure\data\ProjectDatabase;

class GeneratorCombinations {

    private ProjectDatabase $projectDatabase;

    public function __construct(ProjectDatabase $projectDatabase)
    {
        $this->projectDatabase = $projectDatabase;
    }

    /**
     * @throws DateRangeNotAllowedException
     * @throws ValueNotAllowedException
     */
    public function execute() {
        $projects = $this->projectDatabase->getData();
        var_dump($projects);
    }
}