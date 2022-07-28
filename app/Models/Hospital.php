<?php

namespace App\Models;

use App\Enums\InstitutionSubType;
use App\Enums\InstitutionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    public function stations()
    {
        return $this->hasMany(Station::class);
    }
}
