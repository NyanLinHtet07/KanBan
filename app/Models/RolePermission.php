<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

///not use

class RolePermission extends Model
{
    use HasFactory;

    public function role()
    {
        return $this -> belongsTo(Role::class);
    }

    public function Permission()
    {
        return $this -> belongsTo(Permission::class);
    }
}
