<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function all()
    {
        $users = DB::table('users')
                ->select('*')
                ->get();
        
        return $users;
    }
}