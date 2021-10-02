<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; // time


class UserController extends Controller
{
    //
    public function __getAll()
    {
        $result = DB::select('SELECT `id`, `user_name`, `password`, `address`, `gender`, `phone`, `created_at`, `updated_at` FROM `users`');
        return response($result, 200);
    }

    public function __insert(Request $request)
    {
        $user = new Users();
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->save();
        return response()->json(["message: " => "Insert success"], 200);
    }
    public function checkUser($id)
    {
        $result = DB::select('SELECT `id`, `user_name`, `password`, `address`, `gender`, `phone`, `created_at`, `updated_at` FROM `users` where `id` = ?', array($id));
        return $result;
    }
    public function __update(Request $request)
    {
        $user = new Users();
        $user->id = $request->id;
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->updated_at = Carbon::now();
        $resultCheck = $this->checkUser($user->id);
        if (count($resultCheck) > 0) {
            $result = DB::update('UPDATE `users` SET `user_name`= ?,`password`= ?,`address`= ?,`gender`= ?,`phone`= ?,`updated_at` = ? WHERE `id`= ?', array($user->user_name, $user->password, $user->address, $user->gender, $user->phone, $user->updated_at, $user->id));
            // $user->touch();
            if ($result == 1) {

                return response()->json(["message: " => "Updated successfully"], 200);
            } else {
                return response()->json(["message: " => "Updated fail"], 200);
            }
        } else {
            return response()->json(["message: " => "No data"], 200);
        }
    }
    public function __delete(Request $request)
    {
        $user = new Users();
        $user->id = $request->id;
        $result = DB::delete('delete from users where id = ?', array($user->id));
        if ($result == 1) {
            return response()->json(["message: " => "Delete success"], 200);
        } else if ($result != 1) {
            return response()->json(["message: " => "Delete fail"], 200);
        }
    }
    public function __findAddress(Request $request)
    {
        $user = new Users();
        $user->address = $request->address;
        $results = DB::select('select * from users where address = ?', array($user->address));
        return response($results, 200);
    }
    public function __checkUserName($user_name)
    {
        $result = DB::select('SELECT  `user_name` FROM `users` where `user_name` = ?', array($user_name));
        return $result;
    }
    public function __register(Request $request)
    {
        $user = new Users();
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $resultCheck = $this->__checkUserName($user->user_name);

        if (count($resultCheck) === 0) {
            $result = DB::insert('INSERT INTO `users`(`user_name`, `password`, `address`, `gender`, `phone`, `created_at`, `updated_at`) VALUES (?,?, "", 0, "",? , ?)', array($user->user_name, $user->password, $user->created_at, $user->updated_at));
            // $user->touch();
            if ($result == 1) {
                return response()->json(["message: " => "Register successfully"], 200);
            } else {
                return response()->json(["message: " => "Register fail"], 200);
            }
        } else {
            return response()->json(["message: " => "Wrong user name"], 200);
        }
    }
    public function __login(Request $request)
    {
        $user = new Users();
        $user->user_name = $request->user_name;
        $user->password = $request->password;
        $result = DB::select('SELECT `user_name`, `password` FROM `users` WHERE `user_name` = ?', array($user->user_name));
        $password_hash = $result[0]->password; // lấy password đã hash trên database
        if (Hash::check($user->password, $password_hash)) { // check 2 password với nhaux
            return response()->json(["message: " => "Login successfully"], 200);
        } else {
            return response()->json(["message: " => "Login fail"], 200);
        }
    }
}
