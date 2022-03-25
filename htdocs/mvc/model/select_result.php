<?php

function select_result($name, $image, $id, $stock, $date, $change, $err_msg, $link) {

    //POSTした値の代入と現在時刻取得
    $id = $_POST['id'];
    $payment = $_POST['payment'];
    $date = date('Y-m-d H:i:s');

    //購入処理
    $sql = 'SELECT drink_info.name, drink_info.price, drink_info.image, drink_stock.stock 
    FROM drink_info INNER JOIN drink_stock on drink_info.drink_id = drink_stock.drink_id WHERE drink_info.drink_id = '.$id.';';

    //print $sql;

    if ($result = mysqli_query($link, $sql)) {
    
        while ($row = mysqli_fetch_assoc($result)) {
        
            $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
            $image = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
            $stock = htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8');
            $change = $payment - $price;
        }

    } else {

        $err_msg[] = 'SQL失敗:' . $sql;
        print 'select失敗'.$sql;
    }
    //$err_msg[] = 'SQL失敗:' . $sql;
    return array($name, $image, $id, $stock, $date, $change, $result, $err_msg);
}