<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Contract
 *
 * @property int $id
 * @property int $user_id
 * @property int $contract_type_id
 * @property string $start_date
 * @property string|null $estimated_end_date
 * @property string|null $end_date
 * @property int $week_hours
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ContractType $contractType
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Query\Builder|Contract onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Query\Builder|Contract withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Contract withoutTrashed()
 * @mixin \Eloquent
 */
class Contract extends Model
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
        'contract_type_id',
        'start_date',
        'estimated_end_date',
        'end_date',
//        'national_days_id',
//        'regional_days_id',
//        'local_days_id',
        'week_hours'
    ];

    const ICON = 'fas fa-fw fa-file-signature';

    public static $rules = [
        'user_id' => 'required|integer|exists:users,id',
        'contract_type_id' => 'required|integer|exists:contract_types,id',
        'start_date' => 'required|date',
        'estimated_end_date' => 'nullable|date|after:start_date',
        'end_date' => 'nullable|date|after:start_date',
        'week_hours' => 'required|numeric|between:0,40',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contractType(): BelongsTo
    {
        return $this->belongsTo(ContractType::class);
    }
}
