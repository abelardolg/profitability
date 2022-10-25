<?php

declare(strict_types=1);

namespace Profitability\domain\exceptions;

use Exception;

class ValueNotAllowedException extends Exception
{
    const MESSAGE = "Value not allowed";

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }

}