<?php/** * Created by PhpStorm. * User: PC * Date: 06-Jan-18 * Time: 2:30 PM */class panigation{    private $totalItem;   // tổng số phần tử    private $totalItemPerPage; // số phần tử được hiển thị    private $pageRange; // tổng số trang chứa nội dung    private $totalPages;    private $currentPage;  // trang hiện tại    public function __construct($totalItem,$panigation)    {        //$totalItemPerPage = 2,$currentPage= 1,$pageRange = 3      $this -> totalItem = $totalItem;      $this -> totalItemPerPage = $panigation['totalItemPerPage'];      $this -> currentPage  = $panigation['currentPage'];      if($panigation['pageRange'] % 2 == 0){ $panigation['pageRange'] = $panigation['pageRange'] + 1;}      $this -> pageRange = $panigation['pageRange'];      $this -> totalPages = round(($this -> totalItem / $this -> totalItemPerPage),0);    }    public function showPanigation()    {        $pagitionHTML = '';        if ($this->currentPage < 1 ) {            header('location: error.php');            exit();        }        if ($this->totalPages > 1) {            $start = '<li>Start</li>';            $prev  = '<li>previous</li>';            $next = ' <li>Next</li>';            $end = ' <li>End</li>';            $listPage = '';            if ($this->currentPage >= 1) {                if($this->currentPage > 1){                    $start = '<li class="active"><a href="#" onclick="javascript:changePages(1)">Start</a></li>';                    $prev = '<li class="active"><a onclick="javascript:changePages('.($this->currentPage - 1) .')" href="#"/>Prev</li>';                }                if ($this->currentPage < $this->totalPages) {                    $end = ' <li class="active"><a onclick="javascript:changePages(' . ($this->totalPages) . ')" href="#">End</a></li>';                    $next = '<li class="active"><a onclick="javascript:changePages(' . ($this->currentPage + 1) . ')" href="#"/>Next</li>';                }                if ($this->pageRange < $this->totalItem) {                    if ($this->currentPage == $this->totalItem) {                        $startPage = $this->totalItem - $this->pageRange + 1;  // 6 - 3 + 1 = 4                        $endPage = $this->totalItem;                  // 6                    } elseif ($this->currentPage == 1) {                        $startPage = $this->currentPage;   // 1                        $endPage = $this->pageRange;     // 3                    } else {                       $startPage = $this->currentPage - ($this->pageRange - 1) / 2;  // 1 - (3 - 1) / = 1                       $endPage = $this->currentPage + ($this->pageRange - 1) / 2; //2 + 2 = 4 = 4                    }                    if ($startPage < 1) {                        $startPage = 1;                        $endPage = $endPage + 1;                    }                    if ($endPage > $this->totalPages) {                        $endPage = $this->totalPages;                        $startPage = 1;                    }                } else {                    $startPage = 1;                    $endPage = $this->totalItem;                }                for ($i = $startPage; $i <= $endPage; $i++) {                    if ($i == $this->currentPage) {                        $listPage .= '<li class="page">' . $i . '</a></li>';                    } else {                        $listPage .= '<li><a onclick="javascript:changePages(' .$i. ')"  href="#">' . $i . '</a></li>';                    }                }            }                $page = '<li>' . $this->currentPage . ' of ' . $this->totalPages . '</li>';                $pagitionHTML = '<ul>' . $start . $prev . $listPage . $next . $end . $page . '</ul>';                return $pagitionHTML;        }    }}