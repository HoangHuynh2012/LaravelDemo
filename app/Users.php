<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Users extends Model
{
    public $user_name;
    public $password;
    public $address;
    public $gender;
    public $phone;
    public $created_at;
    public $updated_at;
    //
    use Notifiable;
    protected $table = "users";
    protected $fields = ["user_name", "password", "address", "gender", "phone", "created_at", "updated_at"];

    // public function __construct($user_name, $password, $address, $gender, $phone, $created_at, $updated_at)
    // {
    //     $this->user_name = $user_name;
    //     $this->password = $password;
    //     $this->address = $address;
    //     $this->gender = $gender;
    //     $this->phone = $phone;
    //     $this->created_at = $created_at;
    //     $this->updated_at = $updated_at;
    // }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }
}
