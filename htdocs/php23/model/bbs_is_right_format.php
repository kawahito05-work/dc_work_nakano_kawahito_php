<?php
//入力チェック
function is_right_format($name,$comment){

    if (mb_strlen($name) > 20) {
    
        print '名前は20文字以内でお願いします';
    } elseif (mb_strlen($comment) > 100) {
    
        print 'コメントは100文字以内でお願いします';
    } else if ($name === '') {

        print '名前を入力してください';
    } elseif ($comment === '') {

        print 'コメントを入力してください';
    }
}