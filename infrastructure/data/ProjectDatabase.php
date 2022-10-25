<?php

declare(strict_types=1);

namespace Profitability\infrastructure\data;

use Profitability\domain\entities\Project;
use Profitability\domain\exceptions\DateRangeNotAllowedException;
use Profitability\domain\exceptions\ValueNotAllowedException;
use Profitability\domain\valueObjects\DateVO;
use Profitability\domain\valueObjects\Profitability;
use Profitability\domain\valueObjects\StringVO;

class ProjectDatabase
{
    /**
     * @throws DateRangeNotAllowedException
     * @throws ValueNotAllowedException
     */
    public function getData(): array
    {
        return [
            [
                Project::fromProject(
                    StringVO::fromString("MOLINA"),
                    DateVo::fromDate("01/01/2022"),
                    DateVo::fromDate("15/01/2022"),
                    Profitability::fromAmount(14000)
                )->toArray()
            ],
            [
                Project::fromProject(
                    StringVO::fromString("TENERIFE"),
                    DateVo::fromDate("04/01/2022"),
                    DateVo::fromDate("07/01/2022"),
                    Profitability::fromAmount(7000)
                )->toArray()
            ],
            [
                Project::fromProject(
                    StringVO::fromString("ARTURO"),
                    DateVo::fromDate("07/01/2022"),
                    DateVo::fromDate("24/01/2022"),
                    Profitability::fromAmount(19000)
                )->toArray()
            ],
            [
                Project::fromProject(
                    StringVO::fromString("MIJAS"),
                    DateVo::fromDate("15/01/2022"),
                    DateVo::fromDate("31/01/2022"),
                    Profitability::fromAmount(18000)
                )->toArray()
            ]
        ];
    }
}
