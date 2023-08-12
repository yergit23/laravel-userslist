<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class StatusService
{
    public function allStatus()
    {
        $statuses = DB::table('statuses')
                    ->select('*')
                    ->get();

        return $statuses;
    }
}