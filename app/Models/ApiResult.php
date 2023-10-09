<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiResult extends Model
{
    protected $fillable = ['user_input', 'api_result', 'execution_time', 'type'];
}
