<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

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
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
