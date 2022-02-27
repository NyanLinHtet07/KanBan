<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'order', 'user_id'];

    public $timestamps = false;

    
    public function datas()
    {
        return $this->hasMany(Data::class , 'status_id' ,'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
