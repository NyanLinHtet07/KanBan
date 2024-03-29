<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'description', 'order' ,'user_id','status_id', 'start', 'end'];

    
    public function user()
    {
        return $this->belongsTo(User::class );
    }

   
    public function status()
    {
        return $this->belongsTo(Status::class );
    }
}
