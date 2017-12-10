<?php



class EventController
{

    public function actionView($event_id)
    {
        $object = new Event($event_id);
        $event = $object->get_event();
        $date = $object->event_date();
        $event_time = $object->event_time();
        require_once(ROOT . '/views/event/view.php');
        return true;
    }

    public function actionAjax($event_id){
        if (Input::exists()){
            $object = new Event($event_id);
            $event_time = $object->event_time($_POST['date']);
            echo json_encode($event_time);
        }
        return true;
    }

}