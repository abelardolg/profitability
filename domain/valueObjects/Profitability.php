<?php

declare(strict_types=1);

namespace Profitability\domain\valueObjects;

use Profitability\domain\exceptions\ValueNotAllowedException;

class Profitability
{

    private int $value;
    const POSITIVE_THRESHOLD = 1;

    /**
     * @param int $value
     * @throws ValueNotAllowedException
     */
    private function __construct(int $value)
    {
        $this->setValue($value);
    }

    /**
     * @param int $value
     * @return Profitability
     * @throws ValueNotAllowedException
     */
    public static function fromAmount(int $value): self
    {
        return new self($value);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @throws ValueNotAllowedException
     */
    private function setValue(int $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_INT) || self::POSITIVE_THRESHOLD > $value )
            throw new ValueNotAllowedException();

        $this->value = $value;
    }
}