<?php
// Project.php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Project extends Model
{
    use HasFactory, SoftDeletes;
 
    protected $fillable = ['name', 'description', 'owner_id', 'is_public'];
 
    protected $casts = [
        'is_public' => 'boolean',
    ];
 
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
 
    public function bugs()
    {
        return $this->hasMany(Bug::class);
    }
 
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user')->withTimestamps();
    }
}