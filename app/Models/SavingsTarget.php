<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingsTarget extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'current_amount',
        'start_date',
        'target_date',
        'description',
        'is_achieved',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'target_amount'  => 'decimal:2',
        'current_amount' => 'decimal:2',
        'is_achieved'    => 'boolean',
        'start_date'     => 'date',
        'target_date'    => 'date', // Ini akan memastikan tanggal diperlakukan dengan benar
    ];

    /**
     * Get the user that owns the savings target.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}