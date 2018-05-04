<?php

namespace Carbon\Models;
use Illuminate\Database\Eloquent\Model;

class Food extends Model {
    protected $table = 'foods';

    protected $fillable = [
        'user',
        'name',
        'calories',
        'fat',
        'carbs',
        'protein',
    ];

}

?>
