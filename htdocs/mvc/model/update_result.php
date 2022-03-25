<?php

function update_result($id, $stock, $err_msg, $link) {

    $sql = "UPDATE `drink_stock` SET `stock`='".($stock-1)."' WHERE drink_id='".$id."';";

    //print $sql;

    if (mysqli_query($link, $sql) !== TRUE ){
        $err_msg[] = '在庫: updateエラー:' . $sql;
    }

    return $err_msg;
}