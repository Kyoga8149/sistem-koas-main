<?php

namespace App\Traits;

use Exception;

trait CannotBeDeletedTrait
{
    public function delete()
    {
        throw new Exception('Deletion of this data is forbidden by the system.', 400);
    }
}
