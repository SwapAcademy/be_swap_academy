<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';

    protected $fillable = [
        'course_name',
        'category',
        'description',
        'difficulty_level',
        'redemtions',
        'point_earn',
        'duration',
        'credits_required',
    ];

    public function enrollment(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }

    // Relasi ke tabel User (Mentor)
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }
}
