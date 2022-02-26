<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    public function __toString()
    {
        return $this->mark();
    }

    public function getVacancyLevelAttribute(): VacancyLevel
     {
         return new VacancyLevel($this->remainingCount());
     }

     public function remainingCount(): int
     {
         return 0;
     }
}
