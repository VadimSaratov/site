<?php
class Cinema
{

    private $_db,
            $_event_time,
            $_event_id,
            $_orders,
            $_session_id,
            $_date = [],
            $_sessions = [];

    public  $html,
            $date=[];


    public function __construct($event_id, $event_time = null)
    {
        $this->_db = DB::get_instance();
        $this->_event_id = $event_id;
        if ($event_time != null){
            $this->_event_time = $event_time;
        }
    }

    public function get_date(){
       $this->_db->db_select('event_date','sessions', array('event_id', '=', $this->_event_id));
       return $this->date = $this->_db->get_results();
    }


    private function get_orders(){
        $this->_db->db_select('*','orders', array('session_id', '=', $this->_session_id));
        return $this->_sessions = $this->_db->get_results();
    }

    public function generate_time(){

    }

    public function generate_hall(){

    }






}
