<?php

//　設定ファイル読み込み
require_once 'conf/bbs_const.php';

//　関数ファイル読み込み
require_once 'model/bbs_insert.php';
require_once 'model/bbs_is_right_format.php';
require_once 'model/bbs_select.php';
require_once 'model/bbs_start_DB_connection.php';
require_once 'model/bbs_close_DB_connection.php';


//　DB接続
$link = start_DB_connection();

$err_msg = [];
$bbs_data = [];

is_right_format($name, $comment);

if((isset($_POST['name'])===TRUE)&&(isset($_POST['comment'])===TRUE)){
    if(($_POST['name']!=='')&&($_POST['comment']!=='')){

        insert_DB($link);

    }
}

list($result, $bbs_data) = select_DB($link);

// DB切断
close_DB_connect($link);


include_once 'bbs_list.php';