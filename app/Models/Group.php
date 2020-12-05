<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory, SoftDeletes;

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
        'project_id',
        'name',
        'enabled'
    ];

    public static $rules = [
        'project_id' => 'required|exists:projects,id',
        'name' => 'required|string|max:255',
        'enabled' => 'required|boolean',
    ];

    /**
     * Get the project that owns the group.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * The users that belong to the group.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_group');
    }
}
