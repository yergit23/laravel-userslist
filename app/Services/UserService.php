<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function update($request, $id)
    {
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $request->username,
                    'job' => $request->job,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);
    }

    public function updateSafety($request, $id)
    {
        if($request->password) {
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
        }

        DB::table('users')
                ->where('id', $id)
                ->update([
                    'email' => $request->email,
                ]);
    }

    public function updateStatus($request, $id)
    {
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'status' => $request->status,
                ]);
    }

    public function updateMedia($request, $id)
    {
        // Select user with image
        $user = DB::table('users')
                ->select('id', 'name', 'img')
                ->where('id', $id)
                ->first();

        // Remove previous image
        if ($user->img) {
            Storage::delete($user->img);
        }

        // Update image in DB
        $userImage = DB::table('users')
                ->where('id', $id)
                ->update(['img' => $request->file('img')->store('img/demo/avatars')]);
    }

    public function userDelete($id)
    {
        // Select user with image
        $user = DB::table('users')
                ->select('id', 'name', 'img')
                ->where('id', $id)
                ->first();

        // Remove image
        if ($user->img) {
            Storage::delete($user->img);
        }

        DB::table('users')
                ->where('id', $id)
                ->delete();
    }

    public function logout($request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}