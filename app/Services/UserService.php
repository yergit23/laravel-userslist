<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserService
{
    public function all()
    {
        $users = DB::table('users')
                ->select('*')
                ->get();
        
        return $users;
    }

    public function one($id)
    {
        $user = DB::table('users')
                ->select('*')
                ->where('id', $id)
                ->first();
        
        return $user;
    }

    public function addUser($request)
    {
        $userId = DB::table('users')->insertGetId([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now()->format('Y-m-d h:m:s'),
            'updated_at' => Carbon::now()->format('Y-m-d h:m:s'),
            'job' => $request->job,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'vk' => $request->vk,
            'tgm' => $request->tgm,
            'inst' => $request->inst
        ]);

        if ($request->hasFile('img')) {
            DB::table('users')
                    ->where('id', $userId)
                    ->update(['img' => $request->file('img')->store('img/demo/avatars')]);
        } 
    }

    public function update($user, $id)
    {
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $user->username,
                    'job' => $user->job,
                    'phone' => $user->phone,
                    'address' => $user->address,
                ]);
    }

    public function updateSafety($user, $id)
    {
        if($user->password) {
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'email' => $user->email,
                    'password' => Hash::make($user->password),
                ]);
        }

        DB::table('users')
                ->where('id', $id)
                ->update([
                    'email' => $user->email,
                ]);
    }
}