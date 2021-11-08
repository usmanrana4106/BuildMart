<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    use HasFactory;
    protected $table="todo_task";
    protected $fillable = [
        'user_id', 'task', 'created_at', 'updated_at'
    ];
    public $timestamps=false;
}
