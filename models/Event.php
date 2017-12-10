<?php
class Event
{
    private $_db;



    public function __construct($event_id)
    {
        $this->_db = DB::get_instance();
        $this->_event_id = $event_id;

    }
    public function event_date(){
        $this->_db->db_select('*','event_date', array('event_id', '=', $this->_event_id));
        return $this->_db->get_results();
    }
    public function event_time($date = null){
        if ($date == null){
            $this->_db->db_select('date_id','event_date', array('event_id', '=', $this->_event_id));
            $date_id = $this->_db->first_result()['date_id'];
            $this->_db->db_select('event_time','sessions', array('date_id', '=', $date_id));
            return $this->_db->get_results();
        }else{
            $this->_db->db_select('event_time','sessions', array('date_id', '=', $date));
            return $this->_db->get_results();
        }

    }

    public function get_event(){
          $db = $this->_db->db_select('*','events', array('event_id', '=', $this->_event_id));
            return $db->first_result();
    }

//    public static function get_session($event_id){
//        $db = DB::get_instance()->db_select('*','session', array('event_id', '=', $event_id));
//        return $db->get_results();
//    }

}
