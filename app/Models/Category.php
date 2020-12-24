<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
        'name',
        'code',
        'description',
    ];

    const ICON = 'fas fa-boxes';

    public static $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string',
        'description' => 'required|string'
    ];

    /**
     * The users that belong to the category.
     */
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_category');
    }
}
