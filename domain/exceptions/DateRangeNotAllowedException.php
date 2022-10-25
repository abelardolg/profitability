<?php

declare(strict_types=1);

namespace Profitability\domain\exceptions;

use Exception;

class DateRangeNotAllowedException extends Exception
{
    const MESSAGE = "Start date must be before than finish date";

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }


}