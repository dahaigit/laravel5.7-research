<?php
namespace App\Scopes;

class AgeScope implements \Illuminate\Database\Eloquent\Scope
{
    /*
     * 约束
     */
    public function apply(\Illuminate\Database\Eloquent\Builder $builder, \Illuminate\Database\Eloquent\Model $model) {
       $builder->where('name', '=', 'fhqumY5vOX');
    }
}
