<?php

namespace functional;

use PHPUnit\Framework\TestCase;
use Profitability\domain\services\Combinator;
use Profitability\domain\services\GeneratorSuccessors;
use Profitability\domain\services\SorterByProfitability;
use Profitability\domain\services\SorterByStartDateThenEndDate;

class AppTest extends TestCase
{
    /**
     * @test
     */
    public function testProjectsWhenBThenA()
    {
        $sorterByStartDateThenEndDate = new SorterByStartDateThenEndDate();
        $combinator = new Combinator();
        $generatorSuccessors = new GeneratorSuccessors();
        $sorterByProfitability = new SorterByProfitability();

        $sorterByStartDateThenEndDate->linkedWith($combinator)->linkedWith($generatorSuccessors)
            ->linkedWith($sorterByProfitability);


        $projects = [
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534edc",
                "name" => "ProjectA",
                "startDate" => 1642201200,
                "endDate" => 1642201300,
                "profitability" => 14000
            ],
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534ed1",
                "name" => "ProjectB",
                "startDate" => 1642201100,
                "endDate" => 1642201200,
                "profitability" => 14000
            ]
        ];

        $result =
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534ed1,747715fa-7764-46e8-a4a7-0ea7e0534edc",
                "profitability" => 28000
            ];

        $theBestRoadmap = $sorterByStartDateThenEndDate->execute($projects);

        $this->assertEqualsCanonicalizing($theBestRoadmap, $result);
    }

    /**
     * @test
     */
    public function testProjectsWhenOverlappingProjects()
    {

        $sorterByStartDateThenEndDate = new SorterByStartDateThenEndDate();
        $combinator = new Combinator();
        $generatorSuccessors = new GeneratorSuccessors();
        $sorterByProfitability = new SorterByProfitability();

        $sorterByStartDateThenEndDate->linkedWith($combinator)->linkedWith($generatorSuccessors)
            ->linkedWith($sorterByProfitability);

        $projects = [
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534edc",
                "name" => "ProjectA",
                "startDate" => 1642201100,
                "endDate" => 1642201300,
                "profitability" => 12000
            ],
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534ed1",
                "name" => "ProjectB",
                "startDate" => 1642201200,
                "endDate" => 1642201400,
                "profitability" => 14000
            ]
        ];

        $result =
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534ed1",
                "profitability" => 14000
            ];

        $theBestRoadmap = $sorterByStartDateThenEndDate->execute($projects);

        $this->assertEqualsCanonicalizing($theBestRoadmap, $result);
    }

    /**
     * @test
     */
    public function testProjectsWhenTheyStartAtTheSameTime()
    {

        $sorterByStartDateThenEndDate = new SorterByStartDateThenEndDate();
        $combinator = new Combinator();
        $generatorSuccessors = new GeneratorSuccessors();
        $sorterByProfitability = new SorterByProfitability();

        $sorterByStartDateThenEndDate->linkedWith($combinator)->linkedWith($generatorSuccessors)
            ->linkedWith($sorterByProfitability);

        $projects = [
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534edc",
                "name" => "ProjectA",
                "startDate" => 1642201100,
                "endDate" => 1642201300,
                "profitability" => 32000
            ],
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534ed1",
                "name" => "ProjectB",
                "startDate" => 1642201100,
                "endDate" => 1642201300,
                "profitability" => 14000
            ]
        ];

        $result =
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534edc",
                "profitability" => 32000
            ];

        $theBestRoadmap = $sorterByStartDateThenEndDate->execute($projects);

        $this->assertEqualsCanonicalizing($theBestRoadmap, $result);
    }

    /**
     * @test
     */
    public function testProjectsWhenOnlyAProject()
    {

        $sorterByStartDateThenEndDate = new SorterByStartDateThenEndDate();
        $combinator = new Combinator();
        $generatorSuccessors = new GeneratorSuccessors();
        $sorterByProfitability = new SorterByProfitability();

        $sorterByStartDateThenEndDate->linkedWith($combinator)->linkedWith($generatorSuccessors)
            ->linkedWith($sorterByProfitability);

        $projects = [
            [
                "id" => "747715fa-7764-46e8-a4a7-0ea7e0534ed1",
                "name" => "TheOne",
                "startDate" => 1642201100,
                "endDate" => 1642201300,
                "profitability" => 14000
            ]
        ];

        $result = [
            "id" => "747715fa-7764-46e8-a4a7-0ea7e0534ed1",
            "profitability" => 14000
        ];

        $theBestRoadmap = $sorterByStartDateThenEndDate->execute($projects);

        $this->assertEqualsCanonicalizing($theBestRoadmap, $result);
    }

    /**
     * @test
     */
    public function testProjectsWhenNoProjects()
    {

        $sorterByStartDateThenEndDate = new SorterByStartDateThenEndDate();
        $combinator = new Combinator();
        $generatorSuccessors = new GeneratorSuccessors();
        $sorterByProfitability = new SorterByProfitability();

        $sorterByStartDateThenEndDate->linkedWith($combinator)->linkedWith($generatorSuccessors)
            ->linkedWith($sorterByProfitability);

        $projects = [];

        $result = [];

        $theBestRoadmap = $sorterByStartDateThenEndDate->execute($projects);

        $this->assertEqualsCanonicalizing($theBestRoadmap, $result);
    }

}