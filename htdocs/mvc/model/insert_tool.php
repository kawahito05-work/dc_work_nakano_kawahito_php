<?php

function insert_tool($name, $price, $stock, $public, $date, $image_dir, $link, $err_msg){

    
    $revised_msg = ''; 

    //商品追加処理
    $image = $_FILES['userfile']['tmp_name'];

    $sql = "INSERT INTO `drink_info`(`name`, `price`, `create_at`, `update_at`, `public`, `image`) 
            VALUES (N'".$name."','".$price."','".$date."','".$date."','".$public."','".$image_dir."');";

    if (mysqli_query($link, $sql) !== TRUE) {
    
        $err_msg[] = 'drink_info: insertエラー:' . $sql;
    }

    $drink_id = mysqli_insert_id($link);

    $sql = "INSERT INTO `drink_history`(`drink_id`, `bought_at`) VALUES ('".$drink_id."', '".$date."');";

    if (mysqli_query($link, $sql) !== TRUE) {
    
        $err_msg[] = 'drink_history: insertエラー:';
    }

        //$err_msg[] = 'テスト';

    $sql = "INSERT INTO `drink_stock`(`drink_id`,`stock`, `create_at`, `update_at`) 
            VALUES ('".$drink_id."', '".$stock."','".$date."','".$date."');";
    
    if (mysqli_query($link, $sql) !== TRUE) {
    
        $err_msg[] = 'drink_stock: insertエラー:' . $sql;
    }

    if (count($err_msg) === 0){

        $revised_msg = '商品追加成功';
    }

    //$err_msg[] = 'SQL失敗:' . $sql;
    return array($revised_msg, $err_msg);
}