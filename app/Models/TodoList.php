<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;
    protected $table="todo_lists";
    protected $fillable = [
        'user_id', 'todo_description', 'created_at', 'updated_at'
    ];
    public $timestamps=false;
}
