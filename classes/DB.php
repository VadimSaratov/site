<?php

class DB
{
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results = [],
            $_count = 0;

    private function __construct()
    {
            $paramsPath = ROOT . '/config/db_params.php';
            $params = include($paramsPath);
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $this->_pdo = new PDO($dsn, $params['user'], $params['password']);
            $this->_pdo->exec("set names utf8");
    }

    public static function get_instance(){
        if (!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $values = []){
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if (count($values)){
                foreach ($values as $value){
                    $this->_query->bindValue($x,$value,PDO::PARAM_STR);
                        $x++;
                }
            }
            if ($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC);
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }
        return $this;

    }

    private function action($action, $table, $where = [], $operator = null, $where2 = null){
        $operators = ['=','>','<','>=','<='];
        if (count($where) === 3 && $operator == null){
            $field    = $where[0];
            $comparison = $where[1];
            $value    = $where[2];
            if (in_array($comparison, $operators)){
                $sql = "{$action} FROM $table WHERE {$field} {$comparison} ?";
                if (!$this->query($sql,array($value))->error()){
                    return $this;
                }
            }
        }elseif (count($where) === 3 && count($where2) === 3){
            $field = array($where[0], $where2[0]);
            $comparison = array($where[1], $where2[1]);
            $value    = array($where[2], $where2[2]);
            if (in_array($comparison, $operators)){
                $sql = "{$action} FROM $table WHERE {$field[0]} {$comparison[0]} ? {$operator} {$field[1]} {$comparison[1]} ?";
                if (!$this->query($sql,array($value))->error()){
                    return $this;
                }
            }
        }
        return false;
    }

    public function db_select($what, $table, $where, $operator = null, $where2 = null){
        if ($what !== '*'){
            $what = '`'.$what.'`';
            return $this->action('SELECT'. $what, $table, $where, $operator, $where2);
        }
        return $this->action('SELECT *', $table, $where, $operator, $where2);
    }

    public function db_delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }

    public function db_insert($table, $fields = []){
            $keys = array_keys($fields);
            $values = '';
            //$x = 1;
            for ($i = 1; $i <= count($fields); $i++){
                $values .= '?';
                if ($i < count($fields)){
                    $values .= ', ';
                }
            }
//            foreach ($fields as $value){
//                $values .= '?';
//                if ($x < count($fields)){
//                    $values .= ', ';
//                }
//                $x++;
//            }
            $sql = "INSERT INTO {$table} (`" . implode('`, `',$keys) . "`) VALUES({$values})";
            if (!$this->query($sql, $fields)->error()){
                return true;
            }
            return false;
    }

    public function db_update($table, $where = [], $fields = [] ){
        $set = '';
        $x = 1;

        $id_name = $where[0];
        $operator = $where[1];
        $id_value = (int)$where[2];

        foreach ($fields as $name => $value){
            $set .= $name.' = ?';
            if ($x < count($fields)){
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE {$id_name} {$operator} {$id_value}";
        if (!$this->query($sql, $fields)->error()){
            return true;
        }
        return false;
    }



    public function error(){
        return $this->_error;
    }

    public function get_results(){
        return $this->_results;
    }
    public function first_result(){
        return $this->get_results()[0];
    }
    public function get_count(){
        return $this->_count;
    }


}
