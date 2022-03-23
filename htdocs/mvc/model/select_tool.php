<?php

function select_tool($link){

    $err_msg = [];

    //表示データ取得
    $sql = 'SELECT drink_info.drink_id,drink_info.name, drink_info.price, drink_info.public, drink_info.image, drink_stock.stock
    FROM drink_info INNER JOIN drink_stock on drink_info.drink_id = drink_stock.drink_id;';

    if ($result = mysqli_query($link, $sql)) {

        $i = 0;

        while ($row = mysqli_fetch_assoc($result)) {

            $drink_list[$i]['id'] = htmlspecialchars($row['drink_id'], ENT_QUOTES, 'UTF-8');
            $drink_list[$i]['name'] = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            $drink_list[$i]['price'] = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
            $drink_list[$i]['public'] = htmlspecialchars($row['public'], ENT_QUOTES, 'UTF-8');
            $drink_list[$i]['image'] = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
            $drink_list[$i]['stock'] = htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8');
            $i++;
        }

    } else {

        $err_msg[] = 'SQL失敗:' . $sql;
        print 'select失敗'.$sql;
    }
    //$err_msg[] = 'SQL失敗:' . $sql;
    return array($drink_list, $result, $err_msg);
}