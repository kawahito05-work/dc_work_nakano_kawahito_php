<?php

function is_right_result_input() {

    if ($_POST['payment'] === ''){
        
        $err_msg[] = "お金を入力してください";

    } else if (is_numeric($_POST['payment']) === FALSE){

        $err_msg[] = "お金は半角数字で入力してください";
    
    } else if ($_POST['payment'] < 0){

        $err_msg[] = "お金は0円以上を入力してください";

    } else if ($_POST['payment'] > 10000){

        $err_msg[] = "お金は1万円以内を入力してください";

    } 

    if (isset($_POST['id']) === FALSE){

        $err_msg[] = "商品を選択してください";
    }
}