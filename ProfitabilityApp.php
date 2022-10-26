<?php

declare(strict_types=1);

namespace Profitability\application;

require './vendor/autoload.php';

use Profitability\domain\services\Analyzer;
use Profitability\domain\services\Filter;
use Profitability\domain\services\Formatter;
use Profitability\domain\services\GeneratorCombinations;
use Profitability\domain\services\Sorter;
use Profitability\infrastructure\data\ProjectDatabase;

$projects = ProjectDatabase::getData();

$sorter = new Sorter();
$combinator = new GeneratorCombinations();
$filter = new Filter();
$analyzer = new Analyzer();
$formatter = new Formatter();

$sorter->linkedWith($combinator)->linkedWith($filter)->linkedWith($analyzer)->linkedWith($formatter);

$theBestRoadmap = $sorter->execute($projects);

var_dump($theBestRoadmap);

