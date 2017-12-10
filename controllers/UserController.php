<?php
class UserController
{
    public function actionRegister()
    {
        if (Input::exists()) {
            if (Token::check_token(Input::get_value('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'login' => array(
                        'name' => 'логин',
                        'required' => true,
                        'min' => 2,
                        'max' => 20,
                        'regexp_login' => true,
                        'unique' => 'users'
                    ),
                    'name' => array(
                        'name' => 'имя',
                        'required' => true,
                        'min' => 2,
                        'max' => 15,
                        'regexp_name' => true,
                    ),
                    'email' => array(
                        'name' => 'email',
                        'required' => true,
                        'validate_email' => true,
                        'unique' => 'users'
                    ),
                    'password' => array(
                        'name' => 'пароль',
                        'required' => true,
                        'min' => 4,
                        'max' => 15,
                        'regexp_password' => true,
                    ),
                    'password2' => array(
                        'name' => 'повторите пароль',
                        'required' => true,
                        'matches' => 'password'
                    )
                ));
                if ($validation->passed()) {
                   $user = new User();
                   $salt = Hash::salt(10);
                   $result = $user->register(array(
                       'login' => Input::get_value('login'),
                       'user_name' => Input::get_value('name'),
                       'password' => Hash::create(Input::get_value('password'), $salt),
                       'email' => Input::get_value('email'),
                       'joined' => date('Y-m-d H:i:s'),
                       'salt' => $salt
                    ));

                   if ($result){
                       $result = true;
                   }
                } else {
                   $errors = $validation->get_errors();
                }
            }
        }

        require_once ROOT.'/views/user/register.php';

        return true;
    }

    public function actionLogin()
    {
        if (Input::exists()) {
            if (Token::check_token(Input::get_value('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'login' => array(
                        'name' => 'логин',
                        'required' => true
                    ),
                    'password' => array(
                        'name' => 'пароль',
                        'required' => true
                    ),

                ));
                if ($validation->passed()){
                    $user = new User();
                    $result = $user->check_user(Input::get_value('login'),Input::get_value('password'));
                    if ($result){
                        $user->auth($user->data()['user_id']);
                        Redirect::to('/account/');
                    }else{
                        $errors = array('Неправильный логин или пароль');
                    }
                }else{
                    $errors = $validation->get_errors();
                }
            }
        }
        require_once ROOT.'/views/user/login.php';

        return true;
    }


    public function actionAccount()
    {
        $user = new User();
        if (!$user->is_logged_in()){
            Redirect::to('/login');
        }
        if ($user) {
            require_once(ROOT . '/views/user/account.php');
        }
        return true;


    }

    public function actionEdit()
    {
        $user = new User();
        if (!$user->is_logged_in()){
            Redirect::to('/login');
        }
        if (Input::exists()) {
            if (Token::check_token(Input::get_value('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'name' => array(
                        'name' => 'имя',
                        'required' => true,
                        'min' => 2,
                        'max' => 15,
                        'regexp_name' => true,
                    )));
                if (Input::get_value('email') !== $user->data()['email']){
                    $validation = $validate->check($_POST, array(
                        'email' => array(
                            'name' => 'email',
                            'required' => true,
                            'validate_email' => true,
                            'unique' => 'users'
                        )));
                }
                if ($validation->passed()) {
                    if ($user->check_user(User::check_logged(), Input::get_value('password'))) {
                        $result = $user->edit(array(
                            'user_name' => Input::get_value('name'),
                            'email' => Input::get_value('email'),
                        ));
                    }else{
                        $errors = array('Неправильно введен пароль');
                    }
                }else{
                    $errors = $validation->get_errors();
                }
            }
        }
//        }
        require_once(ROOT . '/views/user/edit.php');
        return true;
    }

    public static function actionLogout()
    {
        unset($_SESSION['user_id']);
        unset($_COOKIE['PHPSESSID']);
        Redirect::to('/');
        exit;
    }

}