<?php
class Input{
    public static function exists($type = 'post'){
        switch ($type){
            case 'post':
                return (!empty($_POST))? true: false;
                break;
            case 'get':
                return (!empty($_GET))? true: false;
                break;
            default:
                return false;
        }
    }
    public static function get_value($field){
        if (isset($_POST[$field])){
            return htmlentities($_POST[$field], ENT_QUOTES);
        }elseif (isset($_GET[$field])){
            return htmlentities($_GET[$field], ENT_QUOTES);
        }
        return '';
    }
}