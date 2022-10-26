<?php

declare(strict_types=1);

namespace Profitability\domain\exceptions;

use Exception;

class DateRangeNotAllowedException extends Exception
{
    const MESSAGE = "Start date must be before than finish date";

    /**
     * @throws DateRangeNotAllowedException
     */
    public static function fromBadRequest(): self
    {
        throw new self(self::MESSAGE);
    }


}