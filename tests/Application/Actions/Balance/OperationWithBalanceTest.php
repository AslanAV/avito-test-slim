<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Balance;

use App\Application\Actions\ActionPayload;
use App\Domain\Balance\BalanceRepository;
use App\Domain\Balance\Balance;
use DI\Container;
use Tests\TestCase;

class OperationWithBalanceTest extends TestCase
{
    public function testAction(): void
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $balance = new Balance(1, 1, 100);

        $balanceRepositoryProphecy = $this->prophesize(BalanceRepository::class);
        $balanceRepositoryProphecy
            ->findBalanceOfId(1)
            ->willReturn($balance)
            ->shouldBeCalledOnce();

        $container->set(BalanceRepository::class, $balanceRepositoryProphecy->reveal());

        $request = $this->createRequest('POST', '/1/add/20');

        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, $balance);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
