<?php
//関数読み込み
require_once 'conf/const.php';
require_once 'model/start_DB_connection.php';
require_once 'model/close_DB_connection.php';
require_once 'model/start_transaction.php';
require_once 'model/commit_transaction.php';
require_once 'model/is_right_result_input.php';
require_once 'model/select_result.php';
require_once 'model/update_result.php';


$err_msg = [];
$result = '';
$link = '';
$name = '';
$image = '';
$id = '';
$stock = '';
$date = '';
$change = '';

if ($link = start_DB_connection()) {

    if (isset($_POST['order_flg']) === FALSE){

        $err_msg[] = "不正なアクセスです";
        
    } else {

        //購入処理判定
        //トランザクション開始
        start_transaction($link);

        is_right_result_input();

        if (isset($_POST['order_flg']) === TRUE && $_POST['payment'] !== '' && isset($_POST['id']) === TRUE){


            
            list($name, $image, $id, $stock, $date, $change, $result, $err_msg) = select_result($name, $image, $id, $stock, $date, $change, $err_msg, $link);
            //print $err_msg[0];

            if ($change < 0) {

                $err_msg[] = "お金が足りません";

            }

            if ($stock <= 0) {

                $err_msg[] = "在庫がありません";

            } 

            $err_msg = update_result($id, $stock, $err_msg, $link);
        }
        
        commit_transaction($err_msg, $link);
    
        close_DB_connection($result, $link);

    }
}

include_once 'view/result_list.php';