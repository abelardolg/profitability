<?php

declare(strict_types=1);

namespace Profitability\application;

use Profitability\domain\exceptions\DateRangeNotAllowedException;
use Profitability\domain\exceptions\ValueNotAllowedException;

require './vendor/autoload.php';

$profitability = new Profitability();

try {
    $profitability->execute();
} catch (DateRangeNotAllowedException|ValueNotAllowedException) {
    echo "Sorry, but unfortunately we had an issue. We are working to fix it.";
}