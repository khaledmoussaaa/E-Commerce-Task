<?php

if (!function_exists('get_authUser')) {
    function get_authUser()
    {
        return auth()->user();
    }
};

if (!function_exists('get_authId')) {
    function get_authId()
    {
        return auth()->id();
    }
};

if (!function_exists('get_sessionId')) {
    function get_sessionId()
    {
        return session()->getId();
    }
};
