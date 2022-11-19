<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'url', 'price', 'description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Get details um para muitos
     */
    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Get tenants (Empresas) um para muitos
     */
    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Get profiles many to many
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }


    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate(1);
        return $results;
    }


    /**
     * Perfis disponiveis que não tem ligacao com o plano
     */
    public function profilesAvailable($filter = null)
    {
        $profiles = Profile::whereNotIn('id', function ($query){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter){
                if ($filter){
                    $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
                }
            })
            ->paginate();

        return $profiles;
    }
}
