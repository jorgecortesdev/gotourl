<?php

namespace Xorth\GoToUrl;

use Illuminate\Session\Store;
use Illuminate\Routing\Redirector;

class GoToUrl
{
    private $session;
    private $redirect;
    private $sessionKey = 'GoToUrl';

    function __construct(Store $session, Redirector $redirect)
    {
        $this->session  = $session;
        $this->redirect = $redirect;
    }

    public function after($url)
    {
        $this->flush();

        $this->session->put($this->sessionKey, $url);

        return $this;
    }

    public function now()
    {
        if ($this->session->has($this->sessionKey)) {
            return $this->redirect->to($this->session->get($this->sessionKey));
        }
    }

    public function flush()
    {
        $this->session->forget($this->sessionKey);

        return $this;
    }
}