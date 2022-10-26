<?php

declare(strict_types=1);

namespace Profitability\domain\valueObjects;

use Profitability\domain\exceptions\ValueNotAllowedException;

class StringVO
{

    private string $value;

    /**
     * @param string $value
     * @throws ValueNotAllowedException
     */
    private function __construct(string $value)
    {
        $this->setValue($value);
    }

    /**
     * @param string $value
     * @return StringVO
     * @throws ValueNotAllowedException
     */
    public static function fromString(string $value): self {
        return new self($value);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @throws ValueNotAllowedException
     */
    public function setValue(string $value): void
    {
        if (preg_match("/^[0-9]+$/", $value) || empty($value))
            throw ValueNotAllowedException::fromValue();

        $this->value = $value;
    }

}