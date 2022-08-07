<?php
declare(strict_types=1);

namespace App\Application\Actions\Balance;

use Psr\Http\Message\ResponseInterface as Response;

class OperationWithBalanceAction extends BalanceAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $balanceId = (int) $this->resolveArg('user1');
        $operation = (string) $this->resolveArg('operation');
        $count = (int) $this->resolveArg('count');

        $balance = $this->balanceRepository->findBalanceOfId($balanceId);
        $balance->setCount($count, $operation);

        $this->logger->info("Balance of id `{$balanceId}` was viewed.");

        return $this->respondWithData($balance);
    }
}
