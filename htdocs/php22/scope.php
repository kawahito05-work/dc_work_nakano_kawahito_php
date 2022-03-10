<?php
$str = 'スコープテスト'; // グローバル変数
 
function test_scope() {
    global $str; // グローバル宣言(グローバル変数を参照)
    print $str;
}
 
test_scope();
?>