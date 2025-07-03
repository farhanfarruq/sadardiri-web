<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name', 'icon', 'color', 'type', 'is_default'
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}