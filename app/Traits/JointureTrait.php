<?php
namespace App\Traits;
trait JointureTrait{
    public function scopeJoin($query, $relation){
        // return $this;
        if(!method_exists($this, $relation)){
            return $query;
        }
        // return $this;
        $related=$this->{$relation}();
        // $related=call_user_func([$this,$relation]);
        return $related;
        $table=$related->getRelated()->getTable();
        return $query->join($table, function ($join) use ($related) {
            $join->on($related->getQualifiedForeignKeyName(), '=', $related->getQualifiedOwnerKeyName());
        });
    }
}