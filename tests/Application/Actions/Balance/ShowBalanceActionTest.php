<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Balance;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Application\Handlers\HttpErrorHandler;
use App\Domain\Balance\Balance;
use App\Domain\Balance\BalanceNotFoundException;
use App\Domain\Balance\BalanceRepository;
use DI\Container;
use Slim\Middleware\ErrorMiddleware;
use Tests\TestCase;

class ShowBalanceActionTest extends TestCase
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

        $request = $this->createRequest('GET', '/user1/show');

        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, $balance);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function testActionThrowsUserNotFoundException(): void
    {
        $app = $this->getAppInstance();

        $callableResolver = $app->getCallableResolver();
        $responseFactory = $app->getResponseFactory();

        $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
        $errorMiddleware = new ErrorMiddleware($callableResolver, $responseFactory, true, false, false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);

        $app->add($errorMiddleware);

        /** @var Container $container */
        $container = $app->getContainer();

        $balanceRepositoryProphecy = $this->prophesize(BalanceRepository::class);
        $balanceRepositoryProphecy
            ->findBalanceOfId(1)
            ->willThrow(new BalanceNotFoundException())
            ->shouldBeCalledOnce();

        $container->set(BalanceRepository::class, $balanceRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/user1/show/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedError = new ActionError(ActionError::RESOURCE_NOT_FOUND, 'The Balance you requested does not exist.');
        $expectedPayload = new ActionPayload(404, null, $expectedError);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
