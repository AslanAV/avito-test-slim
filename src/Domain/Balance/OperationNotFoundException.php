<?php
declare(strict_types=1);

namespace App\Domain\Balance;

use App\Domain\DomainException\DomainRecordNotFoundException;

class OperationNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The operation not support.';
}