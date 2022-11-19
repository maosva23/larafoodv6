<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * get Profiles
     * ManyToMany
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
