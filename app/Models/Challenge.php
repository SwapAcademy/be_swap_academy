<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $table = 'challenge';

    protected $fillable = [
        'badge_id',
        'challenge_name',
        'description',
        'reward_credits'
    ];
}
