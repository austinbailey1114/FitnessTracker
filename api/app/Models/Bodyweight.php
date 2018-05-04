<?php

namespace Carbon\Models;
use Illuminate\Database\Eloquent\Model;

class Bodyweight extends Model {
    protected $table = 'bodyweights';

    protected $fillable = [
        'weight',
        'user',
        'date'
    ];

}

?>
