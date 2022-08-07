<?php
declare(strict_types=1);

namespace App\Domain\Balance;

use App\Domain\DomainException\DomainRecordNotFoundException;

class BalanceNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The balance you requested does not exist.';
}