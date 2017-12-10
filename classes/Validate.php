<?php
class Validate{

    private $_result = false,
            $_errors = [],
            $_db = null,
            $_field_name = '';

    public function __construct(){
        $this->_db = DB::get_instance();
    }

    public function check($source,$items = []){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $rule_value){
                $value = htmlentities(trim($source[$item]), ENT_QUOTES);
               if (isset($rules['name'])){
                   $this->_field_name = $rules['name'];
               }
               if ($rule === 'required' && empty($value)){
                   $error = 'Поле ' . $this->_field_name . ' должно быть заполнено!';
                   $this->add_error($item, $error);
               }elseif(!empty($value)){
                   switch ($rule){
                       case 'min':
                           if (mb_strlen($value) < $rule_value){
                               $error = 'Поле ' . $this->_field_name . ' должно быть не меньше ' . $rule_value . ' символов!';
                               $this->add_error($item, $error);
                           }
                           break;
                       case 'max':
                           if (mb_strlen($value) > $rule_value){
                               $error = 'Поле' . $this->_field_name . 'должно быть не больше ' . $rule_value . ' символов!';
                               $this->add_error($item, $error);
                           }
                           break;
                       case 'validate_email':
                           if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
                               $error = 'Некорректно введен ' . $this->_field_name . '!';
                               $this->add_error($item, $error);
                           }
                           break;
                       case 'regexp_login':
                           if (!preg_match('/^[a-zA-Z0-9]{1,20}$/', $value)){
                               $error = 'В поле ' . $this->_field_name . 'могут быть только cтрочные и прописные латинские буквы, цифры!';
                               $this->add_error($item, $error);
                           }
                           break;
                       case 'regexp_name':
                           if (!preg_match('/^[a-zA-Zа-яА-Я]+$/ui', $value)){
                               $error = 'В поле ' . $this->_field_name . ' могут быть только cтрочные и прописные буквы!';
                               $this->add_error($item, $error);
                           }
                           break;
                       case 'matches':
                           if ($value != $source[$rule_value]){
                               $error = 'Пароли не совпадают!';
                               $this->add_error($item, $error);
                           }
                           break;
                       case 'unique':
                           $check = $this->_db->db_select($rule_value, array($item, '=', $value))->get_count();
                           if ($check){
                               $error = 'Данный ' . $this->_field_name . ' занят!';
                               $this->add_error($item, $error);
                           }
                           break;
                   }
               }
            }
        }
        if (empty($this->_errors)){
            $this->_result = true;
        }
        return $this;
    }


    private function add_error($field, $error){
        $this->_errors[$field] = $error;
    }

    public function get_errors(){
        return $this->_errors;
    }
    public function passed(){
        return $this->_result;
    }


}