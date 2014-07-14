<?php

class Paginator {
    private $pages;
    private $numThemes;

    public function __construct(){
        $this->numThemes=10;
    }

    public function getCountPage($messages=array()){
        $size=count($messages);
        $numPage=$size/$this->numThemes;
        $numPage=((int)$numPage==$numPage)?$numPage:(int)$numPage+1;
        $this->pages=$numPage;
    }

    public function getHtmlPaginator(){
        $html="";
        $curPageNum = isset($_GET['page']) ? (int)$_GET['page']: 1;
        $htmlPagin = "<div id='paginator'>page:<ul class='ulPagin'>{{PAGIN}}</ul></div>";
        for($i = 1; $i <= $this->pages; $i++){
            if($i == $curPageNum){
                $html .= "<li >$i</li>";
            } else {
            $html .= "<li><a href='?page=$i'>$i</a></li>";
        }
    }
        $htmlPagin=str_replace("{{PAGIN}}",$html,$htmlPagin);
        return $htmlPagin;
    }
}