<?php

namespace Carbon\Models;
use Illuminate\Database\Eloquent\Model;

class LiftType extends Model {
    protected $table = 'lifttypes';

    protected $fillable = [
        'name',
        'user',
    ];

}

?>
