<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reduction
 *
 * @property int $id
 * @property int $contract_id
 * @property string $start_date
 * @property string|null $end_date
 * @property int $week_hours
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction newQuery()
 * @method static \Illuminate\Database\Query\Builder|Reduction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction query()
 * @method static \Illuminate\Database\Query\Builder|Reduction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Reduction withoutTrashed()
 * @mixin \Eloquent
 */
class Reduction extends Model
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
        'contract_id',
        'start_date',
        'end_date',
        'week_hours'
    ];

    public static $rules = [
        'contract_id' => 'required|integer|exists:contracts,id',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after:start_date',
        'week_hours' => 'required|numeric|between:0,40',
    ];

    /**
     * Get the contract that has a reduction.
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}
