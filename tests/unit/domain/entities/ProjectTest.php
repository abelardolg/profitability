<?php

namespace Profitability\domain\entities;

use PHPUnit\Framework\TestCase;


use Profitability\domain\exceptions\ValueNotAllowedException;
use Profitability\domain\valueObjects\DateVO;
use Profitability\domain\valueObjects\Profitability;
use Profitability\domain\valueObjects\StringVO;


class ProjectTest extends TestCase
{
    /**
     * @test
     */
    public function testWhenCreatingProject()
    {
        $startDate =DateVO::fromDate("2022/02/02");
        $endDate =DateVO::fromDate("2022/02/28");

        $project = Project::fromProject(
            StringVO::fromString("name"),
            $startDate,
            $endDate,
            Profitability::fromAmount(20000)
        );
        $projectId = $project->getId()->getValue();

        $arrayedProduct = $project->toArray();

        $arrayProduct = [
            "id" => $projectId,
            "name" => "name",
            "startDate" => $startDate->getValue()->getTimestamp(),
            "endDate" => $endDate->getValue()->getTimestamp(),
            "profitability" => $project->getProfitability()->getValue()
        ];

        $this->assertEquals($arrayProduct, $arrayedProduct);
    }

    /**
     * @test
     */
    public function testWhenWrongProjectName()
    {
        $startDate =DateVO::fromDate("2022/02/02");
        $endDate =DateVO::fromDate("2022/02/28");


        $this->expectException(ValueNotAllowedException::class);

        Project::fromProject(
            StringVO::fromString(12),
            $startDate,
            $endDate,
            Profitability::fromAmount(20000)
        );
    }

    /**
     * @test
     */
    public function testWhenWrongDateFormat()
    {
        $startDate =DateVO::fromDate("02/02/2022");
        $endDate =DateVO::fromDate("2022/02/28");


        $this->expectException(ValueNotAllowedException::class);

        Project::fromProject(
            StringVO::fromString(12),
            $startDate,
            $endDate,
            Profitability::fromAmount(20000)
        );
    }

    /**
     * @test
     */
    public function testWhenNegativeProfitability()
    {
        $startDate =DateVO::fromDate("2022/02/02");
        $endDate =DateVO::fromDate("2022/02/28");


        $this->expectException(ValueNotAllowedException::class);

        Project::fromProject(
            StringVO::fromString(12),
            $startDate,
            $endDate,
            Profitability::fromAmount(-20000)
        );
    }

    /**
     * @test
     */
    public function testWhenWrongProfitabilityFormat()
    {
        $startDate =DateVO::fromDate("2022/02/02");
        $endDate =DateVO::fromDate("2022/02/28");

        $this->expectException(ValueNotAllowedException::class);

        Project::fromProject(
            StringVO::fromString(12),
            $startDate,
            $endDate,
            Profitability::fromAmount("20000")
        );
    }

}