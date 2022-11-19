<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'nif','name','url','email',
        'logo', 'active', 'subscription', 'expires_at',
        'subscription_id', 'subscription_active','subscription_suspended',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Get Users (Uma Empresa tem muitos usuario e usuario pertence a uma empresa)
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
