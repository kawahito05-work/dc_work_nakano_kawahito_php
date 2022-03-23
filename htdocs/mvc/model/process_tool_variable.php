<?php

function process_tool_variable($err_msg){

    //変数作成
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $public = $_POST['public'];
    $date = date('Y-m-d H:i:s');
    $image_dir = '';

    //画像取得
    $uploaddir = 'uploads/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    echo '<pre>';
    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);

    $file_name=md5(uniqid(rand(), true));
    $file_name .= '.jpg';

    if (count($err_msg) === 0){

        if ( rename( $uploadfile, $uploaddir . $file_name ) ) {
        
            echo "ファイル名の変更に成功しました";
            $image_dir = $uploaddir . $file_name;
        
        } else {
            
            echo "ファイル名の変更に失敗しました";

        }
    }

    return array($name, $price, $stock, $public, $date, $image_dir);
}