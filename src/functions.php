<?php

if ( ! function_exists('go')) {

    function go($url = null)
    {
        $go = app('gotourl');

        if ( ! is_null($url)) {
            return $go->to($url);
        }

        return $go;
    }
}