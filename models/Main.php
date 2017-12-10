<?php

class Main{
    const EVENTS_BY_DEFAULT = 3;
    /*
     * return array with Events
     * */
    public static function getEventsList($page = 1, $count = self::EVENTS_BY_DEFAULT){
        $count = intval($count);
        $page = intval($page);
        $offset = $count * ($page - 1);

        $db = DB::get_instance()->query("SELECT * FROM `events` ORDER BY `event_id` DESC LIMIT $count OFFSET $offset ");
        $event_list = $db->get_results();


//        $db = DB::getConnection();
//
//        $result = $db->query("SELECT * FROM `events` ORDER BY `event_id` DESC LIMIT $count OFFSET $offset ");
//
//        $result->setFetchMode(PDO::FETCH_ASSOC);
//        while ($row = $result->fetch()){
//            $event_list[] = $row;
//        }
        return $event_list;
    }

    public static function get_total_events()
    {
          $db = DB::get_instance()->query("SELECT count(event_id) AS `count` FROM `events`");
          $result = $db->first_result()['count'];
//        $db = DB::getConnection();
//        $result = $db->query("SELECT count(event_id) AS count FROM `events`");
//        $result->setFetchMode(PDO::FETCH_ASSOC);
//        $row = $result->fetch();
//        return $row['count'];
        return $result;
    }

}