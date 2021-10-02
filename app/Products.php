<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Products extends Model
{
    use Notifiable;
    protected $table = "products";
    protected $fields = ["name", "price", "image", "quantity", "category_id", "created_at", "updated_at"];
}
