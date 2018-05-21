<?php

namespace Carbon\Models;
use Illuminate\Database\Eloquent\Model;

class FoodGoal extends Model {
    protected $table = 'foodGoals';

    protected $fillable = [
        'user',
        'calories',
        'fat',
        'carbohydrate',
        'protein',
    ];
}

?>
