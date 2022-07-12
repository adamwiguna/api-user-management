<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Position;

class Organization extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the positions for the Organization
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function scopeSearch($query, $string)
    {
        $query->where('name', 'like', '%'.$string.'%');

        return $query;
    }
}
