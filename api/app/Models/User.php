<?php

namespace Carbon\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'password',
        'exchange_code'
    ];

}

?>
