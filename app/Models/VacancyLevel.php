<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyLevel extends Model
{
    private $remainingCount;

    public function __construct(int $remainingCount)
    {
        $this->remainingCount = $remainingCount;
    }

    public function mark(): string
    {
        if ($this->remainingCount === 0) {
            return '×';
        }
        if ($this->remainingCount === 4) {
            return '△';
        }
        if ($this->remainingCount === 5) {
            return '◎';
        }
    }
}
