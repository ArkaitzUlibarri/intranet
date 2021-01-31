<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $client_id
 * @property string $start_date
 * @property string|null $end_date
 * @property int|null $manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read \App\Models\User|null $manager
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Query\Builder|Project onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Query\Builder|Project withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Project withoutTrashed()
 * @mixin \Eloquent
 */
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

    const ICON = 'fas fa-fw fa-archive';

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
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class)
            ->orderBy('project_id', 'asc')
            ->orderByDesc('name');
    }

    /**
     * Get the client record associated with the project.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the project manager record associated with the project.
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function isActive()
    {
        return $this->end_date != null ? 0 : 1;
    }
}
