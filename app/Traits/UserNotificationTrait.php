<?php

namespace App\Traits;

trait UserNotificationTrait
{
    public function routeNotificationForMail($notification)
    {
        return $this->user->email;
    }
}
