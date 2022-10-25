<?php

namespace Profitability\application;

use Profitability\domain\exceptions\DateRangeNotAllowedException;
use Profitability\domain\exceptions\ValueNotAllowedException;
use Profitability\domain\services\GeneratorCombinations;
use Profitability\infrastructure\data\ProjectDatabase;

$generator = new GeneratorCombinations(new ProjectDatabase());
try {
    $generator->execute();
} catch (DateRangeNotAllowedException|ValueNotAllowedException $e) {
}