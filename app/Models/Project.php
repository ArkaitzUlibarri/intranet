<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
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
        'name',
        'description',
        'client_id',
        'start_date',
        'end_date',
        'manager_id',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'client_id' => 'required|exists:clients,id',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after:start_date',
        'manager_id' => 'required|exists:users,id',
    ];

    /**
     * Get the groups for the project.
     */
    public function groups()
    {
        return $this->hasMany(Group::class)->orderBy('project_id', 'name', 'desc');
    }

    /**
     * Get the client record associated with the project.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the project manager record associated with the project.
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function isActive()
    {
        return $this->end_date != null ? 0 : 1;
    }
}
