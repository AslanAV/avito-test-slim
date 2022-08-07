<?php
declare(strict_types=1);

namespace App\Application\Actions\Balance;

use Psr\Http\Message\ResponseInterface as Response;

class ShowBalanceAction extends BalanceAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $balanceId = (int) $this->resolveArg('user1');

        $balance = $this->balanceRepository->findBalanceOfId($balanceId);

        $this->logger->info("Balance of id `${balanceId}` was viewed.");

        return $this->respondWithData($balance);
    }
}
