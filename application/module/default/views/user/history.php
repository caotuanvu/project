<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 07-Apr-18
 * Time: 9:50 PM
 */

$xhtml = '';
$carts = 0;
foreach ($this->Items as $key => $value) {

    $id     = $value['id'];
    $time   = date('H:i d/m/Y', strtotime($value['date']));

    $book       = json_decode($value['books']);
    $prices     = json_decode($value['prices']);
    $quantiy    = json_decode($value['quantities']);
    $names      = json_decode($value['names']);
    $pictures   = json_decode($value['picture']);
    $tbody = '';
    $total = 0;
    foreach ($book as $keyB => $valueB) {
        $pathPicture =  PUBLIC_FILE . FILE_BOOK . DS . $pictures[$keyB];
         $total   += $prices[$keyB];
         $tbody   .= ' <tbody>
                    <tr>
                        <td><a href="#"><img width="40" src="' . $pathPicture . '" alt=""></a></td>

                        <td>' . $names[$keyB] . '</td>

                        <td>' . $quantiy[$keyB] . '</td>

                        <td>' . number_format($prices[$keyB]) . '</td>
                        </tr>
                    
                </tbody>';
    }

 $xhtml .= '<div class="table-responsive my-table">
            <h3 class="text-danger">Mã đơn hàng: '.$value['id'].' - Thời gian: '.$time.'</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>picture</th>
                       <th>name</th>
                       <th>quantity</th>
                       <th>price</th>
                    </tr>
                </thead>
               '.$tbody.'
            </table>
            <h3 class="pull-right">Total: '.number_format($total).' vnđ</h3>
        </div>';
    $carts += $total;
}

echo $xhtml. '<p>Thanh toán: '.number_format($carts).'</p>';
 ?>





