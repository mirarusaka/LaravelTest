<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function remainingCount(): int
     {
         return $this->capacity - $this->reservations()->count();
     }
}
