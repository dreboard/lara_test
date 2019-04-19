<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $fillable = ['name', 'description'];

    /**
     * Get all of the users.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        //return $this->hasMany(User::class)->orderBy('name', 'asc');
        return $this->morphMany('App\User', 'groupable');
    }
}
