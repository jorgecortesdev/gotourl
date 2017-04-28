<?php

use Xorth\GoToUrl\GoToUrl;
use Mockery as m;

class GoToUrlTest extends PHPUnit_Framework_TestCase
{
    protected $go;
    protected $request;
    protected $redirect;

    public function setUp()
    {
        $this->request  = m::mock('Illuminate\Http\Request');
        $this->redirect = m::mock('Illuminate\Routing\Redirector');
        $this->go       = new GoToUrl($this->request, $this->redirect);
    }

    /** @test */
    public function it_recieve_a_dummy_url()
    {
        $this->request->shouldReceive('session')->withNoArgs()->andReturnUsing(function () {
            $session = m::mock('Illuminate\Session\Storage');
            $session->shouldReceive('forget')->with('GoToUrl');
            $session->shouldReceive('put')->with('GoToUrl', '/dummy/url');
            return $session;
        });

        $this->go->after('/dummy/url');
    }

    /** @test */
    public function it_return_a_redirector_object()
    {
        $this->request->shouldReceive('session')->withNoArgs()->andReturnUsing(function () {
            $session = m::mock('Illuminate\Session\Storage');
            $session->shouldReceive('forget')->with('GoToUrl');
            $session->shouldReceive('put')->with('GoToUrl', '/dummy/url');
            $session->shouldReceive('has')->with('GoToUrl')->andReturn(true);
            $session->shouldReceive('get')->with('GoToUrl')->andReturn('/dummy/url');
            return $session;
        });
        $this->redirect->shouldReceive('to')->with('/dummy/url')->andReturn($this->redirect);

        $this->go->now();
    }
}
