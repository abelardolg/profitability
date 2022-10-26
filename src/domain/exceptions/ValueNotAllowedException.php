<?php

declare(strict_types=1);

namespace Profitability\domain\exceptions;

use Exception;

class ValueNotAllowedException extends Exception
{
    private const MESSAGE = "Value not allowed";

    /**
     * @throws ValueNotAllowedException
     */
    public static function fromValue(): self
    {
        throw new self(self::MESSAGE);
    }

}