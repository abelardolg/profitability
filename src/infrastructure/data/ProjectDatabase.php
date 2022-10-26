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
    public static function getData(): array
    {
        return [
            Project::fromProject(
                StringVO::fromString("MOLINA"),
                DateVo::fromDate("2022/01/01"),
                DateVo::fromDate("2022/01/15"),
                Profitability::fromAmount(14000)
            )->toArray(),
            Project::fromProject(
                StringVO::fromString("TENERIFE"),
                DateVo::fromDate("2022/01/04"),
                DateVo::fromDate("2022/01/07"),
                Profitability::fromAmount(7000)
            )->toArray(),
            Project::fromProject(
                StringVO::fromString("ARTURO"),
                DateVo::fromDate("2022/01/07"),
                DateVo::fromDate("2022/01/24"),
                Profitability::fromAmount(19000)
            )->toArray(),
            Project::fromProject(
                StringVO::fromString("MIJAS"),
                DateVo::fromDate("2022/01/15"),
                DateVo::fromDate("2022/01/31"),
                Profitability::fromAmount(18000)
            )->toArray(),
            Project::fromProject(
                StringVO::fromString("UN_DIA_A"),
                DateVo::fromDate("2022/01/15"),
                DateVo::fromDate("2022/01/15"),
                Profitability::fromAmount(38000)
            )->toArray(),
            Project::fromProject(
                StringVO::fromString("UN_DIA_B"),
                DateVo::fromDate("2022/01/22"),
                DateVo::fromDate("2022/01/22"),
                Profitability::fromAmount(18000)
            )->toArray()
        ];
    }
}
