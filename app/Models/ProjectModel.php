<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProjectModel extends Authenticatable
{
    protected $table = "project";
    protected $fillable = [
        'project_name',
        'planned_start_date',
        'planned_end_date',
        'project_description',
        'actual_start_date',
        'actual_end_date',
        'remarks',
        'user_id',
        'status',
        'is_deleted',
        'created_by',
        'updated_by',
    ];

}