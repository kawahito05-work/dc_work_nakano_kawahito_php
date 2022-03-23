<?php

function is_right_tool_input(){

    //パラメータ正誤確認
    if ($_POST['sql_type'] === 'insert') {
        
        if ($_POST['name'] === ''){
        
            $err_msg[] = '名前を入力してください';
        
        } 
        
        if ($_POST['price'] === ''){
        
            $err_msg[] = '値段を入力してください';
        
        } 
        
        if ($_POST['stock'] === ''){
        
            $err_msg[] = '在庫を入力してください';
        
        }
        
        if (is_numeric($_POST['price']) === FALSE){
        
            $err_msg[] = '値段は半角数字を入力してください';
        
        }
        
        if (is_numeric($_POST['stock']) === FALSE){
        
            $err_msg[] = '在庫は半角数字を入力してください';
        
        }

        if ($_POST['price'] < 0){

            $err_msg[] = '0円以上の価格を入力してください';

        }

        if ($_POST['price'] > 10000){

            $err_msg[] = '価格は1万円以内を入力してください';

        }
        
        if ($_FILES['userfile']['error'] !== 0){

            $err_msg[] = 'ファイルを選択してください';
        
        }

        if ($_POST['public'] !== '1' && $_POST['public'] !== '0'){

            $err_msg[] = '公開ステータスは公開か非公開から選択してください';
        
        }
        
        if($_FILES['userfile']['type'] !== 'image/jpeg' && $_FILES['userfile']['type'] !== 'image/png') {
            
            $err_msg[] = 'ファイル形式が異なります。画像ファイルはJPEG又はPNGのみ利用可能です。';
        
        }
    }
    return array($err_msg);
}