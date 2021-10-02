<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Categorys extends Model
{
    //
    use Notifiable;
    protected $table = "categorys";
    protected $fields = ["name", "image", "created_at", "updated_at"];
}
