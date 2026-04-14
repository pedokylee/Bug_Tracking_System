<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Status extends Model
{
    protected $fillable = ['name', 'color', 'order'];
 
    public $timestamps = false;
 
    public function bugs()
    {
        return $this->hasMany(Bug::class);
    }
}
