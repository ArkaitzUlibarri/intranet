<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Teleworking
 *
 * @property int $id
 * @property int $contract_id
 * @property string $start_date
 * @property string|null $end_date
 * @property bool $monday
 * @property bool $tuesday
 * @property bool $wednesday
 * @property bool $thursday
 * @property bool $friday
 * @property bool $saturday
 * @property bool $sunday
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @method static \Illuminate\Database\Eloquent\Builder|Teleworking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Teleworking newQuery()
 * @method static \Illuminate\Database\Query\Builder|Teleworking onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Teleworking query()
 * @method static \Illuminate\Database\Query\Builder|Teleworking withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Teleworking withoutTrashed()
 * @mixin \Eloquent
 */
class Teleworking extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teleworking';

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
        'contract_id',
        'start_date',
        'end_date',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'monday' => 'boolean',
        'tuesday' => 'boolean',
        'wednesday' => 'boolean',
        'thursday' => 'boolean',
        'friday' => 'boolean',
        'saturday' => 'boolean',
        'sunday' => 'boolean',
    ];

    public static $rules = [
        'contract_id' => 'required|integer|exists:contracts,id',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after:start_date',
        'monday' => 'nullable|boolean',
        'tuesday' => 'nullable|boolean',
        'wednesday' => 'nullable|boolean',
        'thursday' => 'nullable|boolean',
        'friday' => 'nullable|boolean',
        'saturday' => 'nullable|boolean',
        'sunday' => 'nullable|boolean',
    ];

    /**
     * Get the contract that has a reduction.
     */
    public function contract():BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}
