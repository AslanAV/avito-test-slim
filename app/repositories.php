<?php
declare(strict_types=1);

use App\Domain\Balance\BalanceRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use App\Infrastructure\Persistence\Balance\InMemoryBalanceRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => autowire(InMemoryUserRepository::class),
        BalanceRepository::class => autowire(InMemoryBalanceRepository::class)
    ]);
};
