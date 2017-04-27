<?php

if ( ! function_exists('go')) {

    function go($url = null)
    {
        $go = app(Xorth\GoToUrl\GoToUrl::class);

        if ( ! is_null($url)) {
            return $go->to($url);
        }

        return $go;
    }
}