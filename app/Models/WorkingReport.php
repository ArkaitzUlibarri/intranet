<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkingReport extends Model
{
    use SoftDeletes;

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
        'user_id',
        'report_date',
        'activity',
        'project_id',
        'group_id',
        'category_id',
        'time_slots',
        'comments',
        'manager_validation',
        'admin_validation',
    ];

    public static $rules = [
        'user_id' => 'required|integer|exists:users,id',
        'report_date' => 'required|date',
        'activity' => 'required|string',
        'project_id' => 'required|integer|exists:projects,id',
        'group_id' => 'required|integer|exists:groups,id',
        'category_id' => 'required|integer|exists:categories,id',
        'time_slots' => 'required|numeric',
        'comments' => 'nullable|string',
        'manager_validation' => 'nullable|boolean',
        'admin_validation' => 'nullable|boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class)->withTrashed();
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class)->withTrashed();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function validatedByManager(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function validatedByAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
