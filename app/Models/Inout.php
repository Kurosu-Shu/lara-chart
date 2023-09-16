<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inout extends Model
{
    use HasFactory;

    protected $fillable = ['about', 'amount', 'type', 'date'];
}
