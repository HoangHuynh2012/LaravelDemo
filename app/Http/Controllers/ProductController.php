<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // time

class ProductController extends Controller
{
    //
    public function __getAll()
    {
        $result = DB::select('SELECT `id`, `name`, `price`, `image`, `quantity`, `category_id`, `created_at`, `updated_at` FROM `products`');
        return response($result, 200);
    }

    public function __insert(Request $request)
    {
        $user = new Products();
        $user->name = $request->name;
        $user->price = $request->price;
        $user->image = $request->image;
        $user->quantity = $request->quantity;
        $user->category_id = $request->category_id;
        $user->save();
        return response()->json(["message: " => "Insert success"], 200);
    }
    public function checkProduct($id)
    {
        $result = DB::select('SELECT `id`, `name` FROM `products` where `id` = ?', array($id));
        return $result;
    }
    public function __update(Request $request)
    {
        $user = new Products();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->price = $request->price;
        $user->image = $request->image;
        $user->category_id = $request->category_id;
        $user->updated_at = Carbon::now();
        $resultCheck = $this->checkProduct($user->id);
        if (count($resultCheck) > 0) {
            $result = DB::update('UPDATE `products` SET `name`= ?,`price`= ?,`image`= ?,`category_id`= ?,`updated_at` = ? WHERE `id`= ?', array($user->name, $user->price, $user->image, $user->category_id, $user->updated_at, $user->id));
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
        $user = new Products();
        $user->id = $request->id;
        $result = DB::delete('delete from products where id = ?', array($user->id));
        if ($result == 1) {
            return response()->json(["message: " => "Delete success"], 200);
        } else if ($result != 1) {
            return response()->json(["message: " => "Delete fail"], 200);
        }
    }
    public function __getProductById(Request $request)
    {
        $user = new Products();
        $user->id = $request->id;
        $result = DB::select('SELECT `id`, `name`, `price`, `image`, `quantity`, `category_id`, `created_at`, `updated_at` FROM `products` WHERE `id` = ? ', array($user->id));
        return response($result, 200);
    }
    public function __getProductsByCategotyId(Request $request)
    {
        $user = new Products();
        $user->category_id = $request->category_id;
        $result = DB::select('SELECT `id`, `name`, `price`, `image`, `quantity`, `category_id`, `created_at`, `updated_at` FROM `products` WHERE `category_id` = ? ', array($user->category_id));
        return response(($result), 200);
    }
    public function __getCountProductsByCategoryId(Request $request)
    {
        $user = new Products();
        $user->category_id = $request->category_id;
        $result = DB::select('SELECT `id` FROM `products` WHERE `category_id` = ? ', array($user->category_id));
        return response(count($result), 200);
    }
}
