<?php
return array(

    'event/([0-9]+)' => 'event/view/$1',// actionView в EventController
    'eventAjax/([0-9]+)' => 'event/ajax/$1',
    'page=([0-9]+)' => 'main/index/$1',

    'register' => 'user/register',
    'login' => 'user/login',
    'logout' => 'user/logout',

    'account/edit' => 'user/edit',
    'account' => 'user/account',

    '' => 'main/index', // actionIndex в MainController



);
?>
