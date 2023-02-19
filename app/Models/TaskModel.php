<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TaskModel extends Authenticatable
{
    protected $table = "task";
    protected $fillable = [
        'user_id',
        'project_id',
        'task_name',
        'planned_start_date',
        'project_description',
        'planned_end_date',
        'task_description',
        'actual_start_date',
        'actual_end_date',
        'remarks',
        'status',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

}