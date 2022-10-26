<?php

namespace Profitability\domain\abstractions;

interface Handler
{
    public function linkedWith(Handler $handler): Handler;
    public function execute(array $projects): array;
}