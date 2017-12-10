<?php
    class Pagination
    {
        /**
         * @var max link pages
         */
        private $maxPages = 10;
        /**
         * @var index for GET( page= number page)
         */
        private $index;
        /**
         * @var current page
         */
        private $currentPage;
        /**
         * @var total rows in DB
         */
        private $total;
        /**
         * @var limit rows on page
         */
        private $limit;
        /**
         * @var Number of pages in navigation
         */
        private $amountPages;

        /**
         * Set params for navigation
         */

        public function __construct($total, $currentPage, $limit, $index)
        {
            $this->total = $total;
            $this->limit = $limit;
            $this->index = $index;
            $this->amountPages = $this->amount_pages();
            $this->set_current_page($currentPage);

        }

        /**
         * To obtain the total number of pages
         * @return  number of pages
         */

        private function amount_pages()
        {

            return ceil($this->total / $this->limit);
        }

        /**
         * set current page
         */
        private function set_current_page($currentPage)
        {
            $this->currentPage = $currentPage;
            if ($this->currentPage > 0){
                if ($this->currentPage > $this->amountPages){
                    $this->currentPage = $this->amountPages;
                }
            }else
                $this->currentPage = 1;
        }

        /**
         *
         * To get where to start
         *
         * @return array with start and end of count
         */
        private function limits()
        {
            # links on the left (for the active link to be in the middle)
            $leftLinks = $this->currentPage - round($this->maxPages / 2);
            # number of start link
            $start = $leftLinks > 0 ? $leftLinks : 1;
            if ($start + $this->maxPages <= $this->amountPages){
                $end = $start > 1 ? $start + $this->maxPages : $this->maxPages;
            }else {

                $end = $this->amountPages;
                $start = $this->amountPages - $this->maxPages > 0 ? $this->amountPages - $this->maxPages : 1;
            }
            return [$start, $end];
        }


        private function generate_html($page, $text = null){
            if (!$text){
                $text = $page;
            }
            $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
            $pattern = '~/'.$this->index.'[0-9]+~';
            $currentURI = preg_replace($pattern, '',$currentURI);
            if ($page == $this->currentPage){
                return '<li class="active"><a href="'. $currentURI . $this->index . $page . '">' . $text .'</a></li>';
            }else{
                return '<li><a href="'. $currentURI . $this->index . $page . '">' . $text .'</a></li>';
            }

        }

        public function get_links(){
            $links = null;
            $limits = $this->limits();
            $html = '<ul class="pagination">';
            for ($i = $limits[0]; $i <= $limits[1]; $i++){
                    $links .= $this->generate_html($i);
                }

            if (!is_null($links)){
                if ($this->currentPage > 1){
                    $links = $this->generate_html(1,'&lt') . $links;
                }
                if ($this->currentPage < $this->amountPages){
                    $links .= $this->generate_html($this->amountPages, '&gt');
                }
            }
            $html .= $links.'</ul>';
            return $html;
        }



    }