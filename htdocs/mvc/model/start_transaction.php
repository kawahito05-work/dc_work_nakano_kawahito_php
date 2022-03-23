<?php
function start_transaction($link){

    mysqli_set_charset($link, DB_CHARACTER_SET);
    //追加or変更
    //トランザクション開始
    mysqli_autocommit($link, false);
}