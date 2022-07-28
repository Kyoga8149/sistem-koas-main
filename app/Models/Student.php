<?php

namespace App\Models;

use App\Models\Enums\StudentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public const ATTACHMENT_SIP = 'sip';

    protected $casts = [
        'status' => StudentStatus::class,
    ];

    protected $attributes = [
        'status' => StudentStatus::New,
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function sip()
    {
        return $this->morphOne(Attachment::class, 'attachable')
            ->where('key', self::ATTACHMENT_SIP);
    }
}
