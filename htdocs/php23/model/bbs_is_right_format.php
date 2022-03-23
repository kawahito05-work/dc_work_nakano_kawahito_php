<?php

//入力チェック
function is_right_format($err_msg,$name,$comment){

    //$err_msg = '';

    if (mb_strlen($name) > 20) {
    
        $err_msg = '名前は20文字以内でお願いします';
    } elseif (mb_strlen($comment) > 100) {
    
        $err_msg = 'コメントは100文字以内でお願いします';
    } else if ($name === '') {

        $err_msg = '名前を入力してください';
    } elseif ($comment === '') {

        $err_msg = 'コメントを入力してください';
    }

    return $err_msg;
}