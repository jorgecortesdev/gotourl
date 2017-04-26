<?php

use Xorth\GoToUrl\GoToUrl;
use Mockery as m;

class GoToUrlTest extends PHPUnit_Framework_TestCase
{
    protected $go;
    protected $session;
    protected $redirect;

    public function setUp()
    {
        $this->session  = m::mock('Illuminate\Session\Store');
        $this->redirect = m::mock('Illuminate\Routing\Redirector');
        $this->go       = new GoToUrl($this->session, $this->redirect);
    }

    /** @test */
    public function it_recieve_a_dummy_url()
    {
        $this->session->shouldReceive('forget')->with('GoToUrl');
        $this->session->shouldReceive('put')->with('GoToUrl', '/dummy/url');

        $this->go->to('/dummy/url');
    }

    /** @test */
    public function it_return_a_redirector_object()
    {
        $this->session->shouldReceive('forget')->with('GoToUrl');
        $this->session->shouldReceive('put')->with('GoToUrl', '/dummy/url');
        $this->session->shouldReceive('has')->with('GoToUrl')->andReturn(true);
        $this->session->shouldReceive('get')->with('GoToUrl')->andReturn('/dummy/url');
        $this->redirect->shouldReceive('redirect')->with('/dummy/url')->andReturn($this->redirect);

        $this->go->now();
    }
}
