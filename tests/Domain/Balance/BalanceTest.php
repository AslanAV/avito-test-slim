<?php
declare(strict_types=1);

namespace Tests\Domain\Balance;

use App\Domain\Balance\Balance;
use JsonException;
use Tests\TestCase;

class BalanceTest extends TestCase
{
    public function balanceProvider(): array
    {
        return [
            [1, 1, 100,],
            [2, 2, 200,],
            [3, 3, 300,],
            [4, 4, 400,],
            [5, 5, 500,],
        ];
    }

    /**
     * @dataProvider balanceProvider
     * @param int    $id
     * @param int $userId
     * @param int $count
     */
    public function testGetters(int $id, int $userId, int $count): void
    {
        $balance = new Balance($id, $userId, $count);

        $this->assertEquals($id, $balance->getId());
        $this->assertEquals($userId, $balance->getUserId());
        $this->assertEquals($count, $balance->getCount());
    }

    /**
     * @dataProvider balanceProvider
     * @param int $id
     * @param int $userId
     * @param int $count
     * @throws JsonException
     */
    public function testJsonSerialize(int $id, int $userId, int $count): void
    {
        $balance = new Balance($id, $userId, $count);

        $expectedPayload = json_encode([
            'id' => $id,
            'userId' => $userId,
            'count' => $count,
        ], JSON_THROW_ON_ERROR);

        $this->assertEquals($expectedPayload, json_encode($balance, JSON_THROW_ON_ERROR));
    }
}
