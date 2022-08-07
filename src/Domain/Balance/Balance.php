<?php
declare(strict_types=1);

namespace App\Domain\Balance;

use JsonSerializable;
use ReturnTypeWillChange;

class Balance implements JsonSerializable
{
    private ?int $id;

    private int $userId;

    private int $count;

    public function __construct(?int $id, int $userId, int $count)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->count = $count;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count, string $operation): void
    {
        if ($operation === 'add') {
            $this->count += $count;
        }
        if ($operation === 'writeOff') {
            $this->count -= $count;
        }
    }

    public function all(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'count' => $this->count,
        ];
    }

    #[ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'count' => $this->count,
        ];
    }
}
