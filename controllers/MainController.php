<?php



class MainController
{

    public function actionIndex($page = 1)
    {
        $events = Main::getEventsList($page);
        $total = Main::get_total_events();
        $pagination = new Pagination($total, $page, Main::EVENTS_BY_DEFAULT, 'page=');

        require_once(ROOT . '/views/site/index.php');

        return true;
    }


}
