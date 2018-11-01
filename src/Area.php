<?php

namespace RuLong\Area;

use RuLong\Area\Models\Area as AreaModel;

/**
 * 三联动，查询
 */
class Area
{

    public function index($psn)
    {
        return AreaModel::where(['psn' => $psn])->select('sn', 'name')->get() ?? [];
    }

}
