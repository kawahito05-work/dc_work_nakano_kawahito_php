<?php
//DB接続
function start_DB_connection() {

    $host = 'localhost';
    $username = 'root';
    $passwd = '1234';
    $dbname = 'codecamp42254';
    //$link = mysqli_connect($host, $username, $passwd, $dbname);

    return mysqli_connect($host, $username, $passwd, $dbname);
    //return $link;
}
