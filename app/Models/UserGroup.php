<?php

namespace App\Models;

/**
 * Class UserGroup.
 */
class UserGroup extends ApiModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Model validation rules for new items.
     * @var array
     */
    protected static $storeRules = [
        'id' => 'required|string|max:30|unique:user_group,id',
    ];

    /**
     * Get the users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->HasMany(User::class);
    }
}
