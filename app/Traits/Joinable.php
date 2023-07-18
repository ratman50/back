<?php

use Illuminate\Support\Facades\DB;

trait Joinable {

    public function join($table, Closure $callback) {
        return $callback(DB::table($table));       
    }
    
    public function leftJoin($table, Closure $callback) {
        return $callback(DB::table($table)->leftJoin($this->table, $this->primaryKey, $table . '.id'));        
    }
    
    public function rightJoin($table, Closure $callback) {
        return $callback(DB::table($table)->rightJoin($this->table, $this->primaryKey, $table . '.id'));        
    }
    
    public function innerJoin($table, Closure $callback) {
        return $callback(DB::table($table)->join($this->table, $this->primaryKey, $table . '.id'));        
    }
}