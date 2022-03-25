<?php

//関数読み込み
require_once 'conf/const.php';
require_once 'model/start_DB_connection.php';
require_once 'model/close_DB_connection.php';
require_once 'model/start_transaction.php';
require_once 'model/commit_transaction.php';
require_once 'model/select_index.php';

//$j = 1;

//$link = start_DB_connection();
$result = '';
$err_msg = [];
$drink_list = [];

if ($link = start_DB_connection()) {

    list($result, $drink_list, $err_msg) = select_index($link, $drink_list, $err_msg);

    close_DB_connection($result, $link);
}

include_once 'view/index_list.php';