<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Balance;

use App\Domain\Balance\Balance;
use App\Domain\Balance\BalanceNotFoundException;
use App\Domain\Balance\BalanceRepository;

class InMemoryBalanceRepository implements BalanceRepository
{
    /**
     * @var Balance[]
     */
    private array $balances;

    /**
     * @param Balance[]|null $balances
     */
    public function __construct(array $balances = null)
    {
        $this->balances = $balances ?? [
            1 => new Balance(1, 1, 100),
            2 => new Balance(2, 2, 200),
            3 => new Balance(3, 3, 300),
            4 => new Balance(4, 4, 400),
            5 => new Balance(5, 5, 500),
            6 => new Balance(6, 6, 600),
            7 => new Balance(7, 7, 700),
            8 => new Balance(8, 8, 800),
            9 => new Balance(9, 9, 900),
            10 => new Balance(10, 10, 1000),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->balances);
    }

    /**
     * {@inheritdoc}
     */
    public function findBalanceOfId(int $id): Balance
    {
        if (!isset($this->balances[$id])) {
            throw new BalanceNotFoundException();
        }

        return $this->balances[$id];
    }
}
