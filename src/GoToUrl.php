<?php

namespace Xorth\GoToUrl;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class GoToUrl
{
    private $request;
    private $redirect;
    private $sessionKey = 'GoToUrl';

    function __construct(Request $request, Redirector $redirect)
    {
        $this->request  = $request;
        $this->redirect = $redirect;
    }

    public function after($url = null)
    {
        $this->flush();

        if (is_null($url)) {
            $url = $this->request->fullUrl();
        }

        $this->request->session()->put($this->sessionKey, $url);

        return $this;
    }

    public function now()
    {
        if ($this->request->session()->has($this->sessionKey)) {
            return $this->redirect->to($this->request->session()->get($this->sessionKey));
        }
    }

    public function flush()
    {
        $this->request->session()->forget($this->sessionKey);

        return $this;
    }
}