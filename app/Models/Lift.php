<?php

namespace Carbon\Models;
use Illuminate\Database\Eloquent\Model;

class Lift extends Model {
    protected $table = 'lifts';

    protected $fillable = [
        'weight',
        'reps',
        'type',
        'user'
    ];

}

?>
