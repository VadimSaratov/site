<?php
class Token
{
    public static function generate_token()
    {
        return Session::put('token', md5(uniqid()));
    }

    public static function check_token($token)
    {
        if (Session::exists('token') && $token === Session::get('token')){
            Session::delete('token');
            return true;
        }
        return false;
    }
}