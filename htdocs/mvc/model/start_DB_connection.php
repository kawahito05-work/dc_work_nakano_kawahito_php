<?php
//DB接続
function start_DB_connection() {
    
    return mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
    //return $link;
}
