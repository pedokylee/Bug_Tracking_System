<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Comment extends Model
{
    use HasFactory;
 
    protected $fillable = ['content', 'bug_id', 'user_id'];
 
    public function bug()
    {
        return $this->belongsTo(Bug::class);
    }
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
