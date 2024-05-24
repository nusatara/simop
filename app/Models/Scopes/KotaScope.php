<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Auth;

class KotaScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole(['upb'])) {
                $builder->where('id_kota', Auth::user()->id_kota)->where('id_kecamatan', Auth::user()->id_kecamatan)->where('id_desa', Auth::user()->id_desa);
            } else {

            }
        }

    }
}
