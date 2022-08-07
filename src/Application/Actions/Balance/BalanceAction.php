<?php
declare(strict_types=1);

namespace App\Application\Actions\Balance;

use App\Application\Actions\Action;
use App\Domain\Balance\BalanceRepository;
use Psr\Log\LoggerInterface;

abstract class BalanceAction extends Action
{
    protected BalanceRepository $balanceRepository;

    public function __construct(LoggerInterface $logger, BalanceRepository $balanceRepository)
    {
        parent::__construct($logger);
        $this->balanceRepository = $balanceRepository;
    }
}