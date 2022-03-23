<?php

function update_tool($err_msg, $link) {


    $id = $_POST['id'];

    //在庫変更処理
    if (isset($_POST['stock']) === TRUE){
        //print '在庫更新';
        
        if (is_numeric($_POST['stock']) === FALSE){
    
            $err_msg[] = '在庫は半角数字を入力してください';
        }

        $stock = $_POST['stock'];
        $sql = "UPDATE `drink_stock` SET `stock`='".$stock."' WHERE drink_id='".$id."';";

        if (mysqli_query($link, $sql) !== TRUE ){
            
            $err_msg[] = '在庫: updateエラー:';
        
        } else {

            $revised_msg = '在庫更新完了';
        
        }

    //ステータス変更処理
    } else if (isset($_POST['public']) === TRUE){

        if ($_POST['public'] !== '1' && $_POST['public'] !== '0'){

            $err_msg[] = '公開ステータスは公開か非公開から選択してください';
            
        } else {
            
            $public = $_POST['public'];
            $sql = "UPDATE `drink_info` SET `public`='".$public."' WHERE drink_id='".$id."';";

            if (mysqli_query($link, $sql) !== TRUE ){
            
                $err_msg[] = 'ステータス: updateエラー:' . $sql;
            
            } else {
            
                $revised_msg = 'ステータス更新完了';

            }
        }
    }
    //$err_msg[] = 'ステータス: updateエラー:' . $sql;
    return array($revised_msg, $err_msg);
}