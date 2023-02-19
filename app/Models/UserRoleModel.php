<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class UserRoleModel extends Authenticatable
{
    use HasFactory;
    protected $table = "user_role";
   
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'is_deleted'
    ];

}