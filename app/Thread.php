<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public $fillable = ['user_id', 'title', 'body'];
}
