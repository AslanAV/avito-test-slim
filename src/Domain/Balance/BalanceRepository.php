<?php
declare(strict_types=1);

namespace App\Domain\Balance;

interface BalanceRepository
{
    /**
     * @return Balance[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Balance
     * @throws BalanceNotFoundException
     */
    public function findBalanceOfId(int $id): Balance;
}
