<?php

namespace App\Models;

use App\Traits\CannotBeDeletedTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, CannotBeDeletedTrait;

    const KOAS_SCHEDULE_WEEK = 'koas_schedule_week';

    public function save(array $options = [])
    {
        // update the cache
        Cache::forever($this->key, $this->value);

        return parent::save($options);
    }
}
