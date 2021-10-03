<?php

namespace App\Http\Controllers;

use App\Categorys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // time

class CategoryController extends Controller
{
    //
    public function __getAll()
    {
        $result = DB::select('SELECT `id`, `name`, `image`, `created_at`, `updated_at` FROM `categorys`');
        return response($result, 200);
    }

    public function __insert(Request $request)
    {
        $user = new Categorys();
        $user->name = $request->name;
        $user->image = $request->image;
        $user->save();
        return response()->json(["message: " => "Insert success"], 200);
    }
    public function checkCategory($id)
    {
        $result = DB::select('SELECT `id`, `name`, `image`,`created_at`, `updated_at` FROM `categorys` where `id` = ?', array($id));
        return $result;
    }
    public function __update(Request $request)
    {
        $user = new Categorys();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->image = $request->image;
        $user->updated_at = Carbon::now();
        $resultCheck = $this->checkCategory($user->id);
        if (count($resultCheck) > 0) {
            $result = DB::update('UPDATE `categorys` SET `name`= ?,`image`= ?,`updated_at` = ? WHERE `id`= ?', array($user->name, $user->image, $user->updated_at, $user->id));
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
        $user = new Categorys();
        $user->id = $request->id;
        $result = DB::delete('delete from categorys where id = ?', array($user->id));
        if ($result == 1) {
            return response()->json(["message: " => "Delete success"], 200);
        } else if ($result != 1) {
            return response()->json(["message: " => "Delete fail"], 200);
        }
    }
    public function __getCategoryById(Request $request)
    {
        $user = new Categorys();
        $user->id = $request->id;
        $result = DB::select('SELECT `id`, `name`, `image`, `created_at`, `updated_at` FROM `categorys` where `id` = ?', array($user->id));
        return response($result, 200);
    }
}
