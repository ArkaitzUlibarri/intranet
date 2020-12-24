<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
