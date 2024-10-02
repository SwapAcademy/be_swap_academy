<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentoring extends Model
{
    use HasFactory;

    protected $table = 'mentoring';

    protected $fillable = [
        'link',
        'mentoring_name',
        'category',
        'description',
    ];
}
