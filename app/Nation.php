<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nation extends Model
{
    use SoftDeletes;
 
    protected $fillable = array('title');
        
    protected $hidden = array(
        'created_at','updated_at','deleted_at'
    );
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function createdDate()
    {
        return (new Carbon($this->created_at))->diffForHumans();//format('H:i d.m.y');
    }
    
    public function updatedDate()
    {
        return (new Carbon($this->updated_at))->diffForHumans();
    }
}
