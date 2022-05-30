<?php

namespace Xorth\GoToUrl\Tests;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Mockery\MockInterface;
use Xorth\GoToUrl\GoToUrl;

class GoToUrlTest extends TestCase
{
    /** @test */
    public function it_receive_a_dummy_url()
    {
        $request = $this->partialMock(Request::class, function (MockInterface $mock) {
            $mock->shouldReceive('session')
                ->withNoArgs()
                ->andReturnUsing(function () {
                    return $this->mock('Illuminate\Session\Storage', function (MockInterface $mock) {
                        $mock->shouldReceive('forget')->with('GoToUrl');
                        $mock->shouldReceive('put')->with('GoToUrl', '/dummy/url');
                    });
                });
        });

        /** @var Request $request */
        (new GoToUrl($request, redirect()))->after('/dummy/url');
    }

    /** @test */
    public function it_return_a_redirector_object()
    {
        $request = $this->partialMock(Request::class, function (MockInterface $mock) {
            $mock->shouldReceive('session')
                ->withNoArgs()
                ->andReturnUsing(function () {
                    return $this->mock('Illuminate\Session\Storage', function (MockInterface $mock) {
                        $mock->shouldReceive('has')->with('GoToUrl')->andReturn(true);
                        $mock->shouldReceive('get')->with('GoToUrl')->andReturn('/dummy/url');
                    });
                });
        });

        $redirect = $this->partialMock(Redirector::class, function (MockInterface $mock) {
            $mock->shouldReceive('to')->with('/dummy/url');
        });

        /**
         * @var Request $request
         * @var Redirector $redirect
         */
        (new GoToUrl($request, $redirect))->now();
    }
}
