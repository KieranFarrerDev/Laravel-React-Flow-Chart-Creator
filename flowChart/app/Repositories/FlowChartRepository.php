<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowChart;

class FlowChartRepository extends AbstractRepository
{
    public static string $modelClass = FlowChart::class;

}
