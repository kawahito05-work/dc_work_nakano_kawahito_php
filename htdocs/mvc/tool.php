<?php
//関数読み込み
require_once 'conf/const.php';
require_once 'model/is_right_tool_input.php';
require_once 'model/start_DB_connection.php';
require_once 'model/close_DB_connection.php';
require_once 'model/start_transaction.php';
require_once 'model/process_tool_variable.php';
require_once 'model/insert_tool.php';
require_once 'model/update_tool.php';
require_once 'model/select_tool.php';
require_once 'model/commit_transaction.php';

$create_at = '';
$update_at = '';
$image = '';
$image_dir = '';
$drink_list = [];
$err_msg = [];
$revised_msg = ''; 
$drink_id;

if ($link = start_DB_connection()) {

    start_transaction($link);

    if (isset($_POST['sql_type']) === TRUE){

        //商品追加処理

        //パラメータ正誤確認
        if ($_POST['sql_type'] === 'insert') {
            
            $tmp_arr = is_right_tool_input();
            //print $tmp[0][0];
            $err_msg = array_merge($err_msg, $tmp_arr[0]);

            list($name, $price, $stock, $public, $date, $image_dir) = process_tool_variable($err_msg);

            print "</pre>";

            $tmp_arr = array();
            list($revised_msg, $tmp_arr) = insert_tool($name, $price, $stock, $public, $date, $image_dir, $link, $err_msg);
            $err_msg = array_merge($tmp_arr);

        //在庫orステータス変更
        } else if ($_POST['sql_type'] === 'update'){

            list($revised_msg, $tmp_arr) = update_tool($err_msg, $link);
            $err_msg = array_merge($err_msg, $tmp_arr);
        }
    }

    //トランザクション終了
    commit_transaction($err_msg, $link);

    list($drink_list, $result, $tmp_arr) = select_tool($link);
    $err_msg = array_merge($err_msg, $tmp_arr);

    close_DB_connection($result, $link);
}

//結果表示
for ($i = 0; $i < count($err_msg); $i++) {
    print $err_msg[$i]."<br>";
}

if ($revised_msg !== ''){

    print $revised_msg;
}

include_once 'view/tool_list.php';