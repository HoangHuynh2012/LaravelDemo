<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Users extends Model
{
    //
    use Notifiable;
    protected $table = "users";
    protected $fields = ["user_name", "password", "address", "gender", "phone", "created_at", "updated_at"];
}
