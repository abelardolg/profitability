<?php

declare(strict_types=1);

namespace Profitability\domain\valueObjects;

use DateTimeImmutable;
use Exception;

use Profitability\domain\exceptions\ValueNotAllowedException;


class DateVO
{

    private DateTimeImmutable $value;

    /**
     * @param string $value
     * @throws ValueNotAllowedException
     */
    private function __construct(string $value)
    {
        $this->setValue($value);
    }

    /**
     * @throws ValueNotAllowedException
     */
    public static function fromDate(string $value): self {
        return new self($value);
    }

    /**
     * @return DateTimeImmutable
     */
    public function getValue(): DateTimeImmutable
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @throws ValueNotAllowedException
     */
    private function setValue(string $value): void
    {
        if (!strtotime($value))
            throw ValueNotAllowedException::fromValue();

        try{
            $this->value = new DateTimeImmutable($value);
        } catch(Exception $ex) {
            throw new ValueNotAllowedException();
        }

    }

}