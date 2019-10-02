<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'todo_name',
        'completed',
        'edit'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
