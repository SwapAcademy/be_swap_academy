<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Badge extends Model
{
    use HasFactory;

    protected $table = 'badge';

    protected $fillable = [
        'users_id',
        'badge_name',
        'description',
        'required_action',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function challenge(): HasMany
    {
        return $this->hasMany(Challenge::class, 'badge_id', 'id');
    }
}
