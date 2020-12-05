<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

      /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ICON = 'fas fa-fw fa-user';

    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email|max:255',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /**
     * The categories that belong to the user.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class,'user_category');
    }

    /**
     * The groups that belong to the user.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class,'user_group');
    }

    /**
     * Return the projects which a user is manager.
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'manager_id');
    }

    public function activeSession()
    {
        return $this->sessions->last();
    }

    public function getLastLoginAttribute()
    {
        return $this->activeSession() ? $this->activeSession()->last_activity : null;
    }
}
