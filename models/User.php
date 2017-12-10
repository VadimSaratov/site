<?php

class User
{

    private $_db,
            $_data,
            $_isLoggedIn;

    public function __construct($user = null)
    {
        $this->_db = DB::get_instance();
        if (!$user){
            if (Session::exists('user_id')){
                $user = Session::get('user_id');
                if ($this->find($user)){
                    $this->_isLoggedIn = true;
                }else{

                }
            }

        }
    }

    public function register($items)
    {
        if ($this->_db->db_insert('users', $items)) {
            return true;
        }
        return false;

    }

    public function find($login = null)
    {
        if ($login) {
            $field = (is_numeric($login)) ? 'user_id' : 'login';
            $data = $this->_db->db_select('*','users', array($field, '=', $login));
            if ($data->get_count()) {
                $this->_data = $data->first_result();
                return true;
            }
        }
        return false;

    }

    public function edit($items)
    {
        if ($this->_db->db_update('users',array('user_id', '=', $this->data()['user_id']), $items)) {
            return true;
        }
        return false;
    }

    public function check_user($login, $password)
    {
        $user = $this->find($login);
        if ($user) {
            if ($this->data()['password'] === Hash::create($password, $this->data()['salt'])) {
                return true;
            }
        }
        return false;
    }

    public function data()
    {
        return $this->_data;
    }

    public function auth($userID)
    {
        session_set_cookie_params('3600');
        session_regenerate_id();
        Session::put('user_id', $userID);
    }

    public static function check_logged()
    {
        if (Session::exists('user_id')) {
            return Session::get('user_id');
        }
        Redirect::to('/login');
        exit;
    }

    public static function isGuest()
    {
        if (Session::exists('user_id')) {
            return false;
        }
        return true;
    }

    public static function get_user_by_id($id)
    {
        if ($id) {
            $db = DB::get_instance();
            $db->db_select('*','users', array('user_id', '=', $id));
            return $db->first_result();
        }
        return false;
    }

    public function is_logged_in(){
        return $this->_isLoggedIn;
    }
}

?>