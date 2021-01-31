<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ContractType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $working_day
 * @property string|null $characteristic_1
 * @property string|null $characteristic_2
 * @property int|null $holidays
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contract[] $contracts
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType newQuery()
 * @method static \Illuminate\Database\Query\Builder|ContractType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType query()
 * @method static \Illuminate\Database\Query\Builder|ContractType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ContractType withoutTrashed()
 * @mixin \Eloquent
 */
class ContractType extends Model
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
        'id',
        'code',
        'name',
        'working_day',
        'characteristic_1',
        'characteristic_2',
        'holidays'
    ];

    const ICON = 'fas fa-fw fa-file-contract';

    public static $rules = [
        'code' => 'required|string|unique:contract_types,code|max:3',
        'name' => 'required|string|max:255',
        'working_day' => 'required|string',
        'characteristic_1' => 'nullable|string',
        'characteristic_2' => 'nullable|string',
        'holidays' => 'nullable|numeric',
    ];

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
