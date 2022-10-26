<?php

namespace functional;

use PHPUnit\Framework\TestCase;
use Profitability\domain\services\Analyzer;
use Profitability\domain\services\Filter;
use Profitability\domain\services\Formatter;
use Profitability\domain\services\GeneratorCombinations;
use Profitability\domain\services\Sorter;

class AppTest extends TestCase
{
    /**
     * @test
     */
    public function testProjectsWhenBThenA()
    {
        $sorter = new Sorter();
        $combinator = new GeneratorCombinations();
        $filter = new Filter();
        $analyzer = new Analyzer();
        $formatter = new Formatter();

        $sorter->linkedWith($combinator)->linkedWith($filter)->linkedWith($analyzer)->linkedWith($formatter);


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
                "from" => "ProjectB",
                "to" => "ProjectA",
                "profitability" => 28000
            ];

        $expectedSortedProjects = $sorter->execute($projects);

        $this->assertEqualsCanonicalizing($expectedSortedProjects, $result);
    }

    /**
     * @test
     */
    public function testProjectsWhenOverlappingProjects()
    {

        $sorter = new Sorter();
        $combinator = new GeneratorCombinations();
        $filter = new Filter();
        $analyzer = new Analyzer();
        $formatter = new Formatter();

        $sorter->linkedWith($combinator)->linkedWith($filter)->linkedWith($analyzer)->linkedWith($formatter);


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
                "from" => "ProjectB",
                "to" => [],
                "profitability" => 14000
            ];

        $expectedSortedProjects = $sorter->execute($projects);

        $this->assertEqualsCanonicalizing($expectedSortedProjects, $result);
    }

    /**
     * @test
     */
    public function testProjectsWhenTheyStartAtTheSameTime()
    {

        $sorter = new Sorter();
        $combinator = new GeneratorCombinations();
        $filter = new Filter();
        $analyzer = new Analyzer();
        $formatter = new Formatter();

        $sorter->linkedWith($combinator)->linkedWith($filter)->linkedWith($analyzer)->linkedWith($formatter);


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
                "from" => "ProjectA",
                "to" => [],
                "profitability" => 32000
            ];

        $expectedSortedProjects = $sorter->execute($projects);

        $this->assertEqualsCanonicalizing($expectedSortedProjects, $result);
    }

    /**
     * @test
     */
    public function testProjectsWhenNoProjects()
    {

        $sorter = new Sorter();
        $combinator = new GeneratorCombinations();
        $filter = new Filter();
        $analyzer = new Analyzer();
        $formatter = new Formatter();

        $sorter->linkedWith($combinator)->linkedWith($filter)->linkedWith($analyzer)->linkedWith($formatter);

        $projects = [];

        $result = [];

        $expectedSortedProjects = $sorter->execute($projects);

        $this->assertEqualsCanonicalizing($expectedSortedProjects, $result);
    }

}