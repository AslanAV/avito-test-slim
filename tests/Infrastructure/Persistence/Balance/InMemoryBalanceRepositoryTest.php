<?php
declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\Balance;

use App\Domain\Balance\Balance;
use App\Domain\Balance\BalanceNotFoundException;
use App\Infrastructure\Persistence\Balance\InMemoryBalanceRepository;
use Tests\TestCase;

class InMemoryBalanceRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $balance = new Balance(1, 1, 100);

        $balanceRepository = new InMemoryBalanceRepository([1 => $balance]);

        $this->assertEquals([$balance], $balanceRepository->findAll());
    }

    public function testFindAllBalancesByDefault(): void
    {
        $balances = [
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

        $balanceRepository = new InMemoryBalanceRepository();

        $this->assertEquals(array_values($balances), $balanceRepository->findAll());
    }

    /**
     * @throws BalanceNotFoundException
     */
    public function testFindBalanceOfId(): void
    {
        $balance = new Balance(1, 1, 100);

        $balanceRepository = new InMemoryBalanceRepository([1 => $balance]);

        $this->assertEquals($balance, $balanceRepository->findBalanceOfId(1));
    }

    public function testFindUserOfIdThrowsNotFoundException(): void
    {
        $balanceRepository = new InMemoryBalanceRepository([]);
        $this->expectException(BalanceNotFoundException::class);
        $balanceRepository->findBalanceOfId(1);
    }
}
