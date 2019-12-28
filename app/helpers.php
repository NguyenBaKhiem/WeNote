<?php

use App\Consts;

if (!function_exists('reset_password_url')) {
    function reset_password_url($token = '')
    {
        return url(config('app.url').Consts::AUTH_ROUTE_RESET_PASSWORD.$token);
    }
}

if (!function_exists('confirm_email_url')) {
    function confirm_email_url($code = '') {
        return url(config('app.url').Consts::AUTH_ROUTE_CONFIRM_EMAIL.$code);
    }
}

if (!function_exists('grant_device_url')) {
    function grant_device_url($code = '') {
        return url(config('app.url').Consts::AUTH_ROUTE_GRANT_DEVICE.$code);
    }
}

if (!function_exists('base64url_encode')) {
    function base64url_encode($data = '')
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

if (!function_exists('base64url_decode')) {
    function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
