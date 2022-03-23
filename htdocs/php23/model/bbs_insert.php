<?php

function insert_DB($link){

    //date_default_timezone_set('Asia/Tokyo');
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $date = date("Y/m/d H:i:s");
    mysqli_set_charset($link, 'utf8');

    $query = 'INSERT INTO bbs(name, comment, date) VALUES(\''.$name.'\',\''.$comment.'\',\''.$date.'\')';
    
    if (mysqli_query($link, $query) === TRUE){
        print '追加成功';
    } else {
        print '追加失敗';
    }
}