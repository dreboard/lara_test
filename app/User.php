<?php

namespace App;

use App\Events\UserSaving;
use App\Observers\User as UserObserveClass;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

/**
 * Class User
 * @package App
 * All additional features are in UserServiceProvider::boot
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $perPage = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','groupable_type', 'groupable_id', 'profile_img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'isAdmin' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($model){
            event(new UserSaving($model));
            Log::info(__CLASS__.' creating '.$model);
        });
        static::created(function($model){
            Log::info(__CLASS__.' created '.$model);
        });
        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('email', 'asc');
        });

        static::observe(new UserObserveClass);

    }
    /**
     * @return string
     * Usage: <a href="{{ $user->path() }}">{{ $user->name }}</a>
     */
    public function path()
    {
        return '/user/' . $this->id;
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     * $user->filter->nonAdmin();
     */
    public function nonAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Get all of the owning commentable models.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function groupable()
    {
        return $this->morphTo();
    }

    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
