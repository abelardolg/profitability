<?php

declare(strict_types=1);

namespace Profitability\domain\entities;

use Ramsey\Uuid\Uuid;

use Profitability\domain\exceptions\DateRangeNotAllowedException;
use Profitability\domain\exceptions\ValueNotAllowedException;
use Profitability\domain\valueObjects\DateVO;
use Profitability\domain\valueObjects\Profitability;
use Profitability\domain\valueObjects\StringVO;


class Project
{
    private StringVO $id;
    private StringVO $name;
    private DateVO $start;
    private DateVO $finish;
    private Profitability $profitability;

    /**
     * @param StringVO $name
     * @param DateVO $start
     * @param DateVO $finish
     * @param Profitability $profitability
     * @throws DateRangeNotAllowedException | ValueNotAllowedException
     * @throws ValueNotAllowedException
     */
    private function __construct(StringVO $name, DateVO $start, DateVO $finish, Profitability $profitability)
    {
        $this->id = StringVO::fromString(Uuid::uuid4()->toString());
        $this->name = $name;
        $this->start = $start;
        $this->setFinish($finish);
        $this->profitability = $profitability;
    }

    /**
     * @param StringVO $name
     * @param DateVO $start
     * @param DateVO $finish
     * @param Profitability $profitability
     * @return Project
     * @throws DateRangeNotAllowedException | ValueNotAllowedException
     */
    public static function fromProject(StringVO $name, DateVO $start, DateVO $finish, Profitability $profitability): Project {
        return new self ($name, $start, $finish, $profitability);
    }

    /**
     * @return StringVO
     */
    public function getId(): StringVO
    {
        return $this->id;
    }



    /**
     * @return StringVO
     */
    public function getName(): StringVO
    {
        return $this->name;
    }

    /**
     * @return DateVO
     */
    public function getStart(): DateVO
    {
        return $this->start;
    }

    /**
     * @return DateVO
     */
    public function getFinish(): DateVO
    {
        return $this->finish;
    }

    /**
     * @return Profitability
     */
    public function getProfitability(): Profitability
    {
        return $this->profitability;
    }

    /**
     * @param DateVO $finish
     * @throws DateRangeNotAllowedException
     */
    public function setFinish(DateVO $finish): void
    {
        if ($this->start->getValue() > $this->finish->getValue())
            throw new DateRangeNotAllowedException();

        $this->finish = $finish;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "name" => $this->name->getValue(),
            "startDate" => $this->start->getValue()->getTimestamp(),
            "endDate" => $this->finish->getValue()->getTimestamp(),
            "profitability" => $this->profitability->getValue()
        ];
    }

}