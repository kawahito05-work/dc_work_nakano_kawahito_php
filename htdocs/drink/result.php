<?php
$host = 'localhost';
$user_name = 'root';
$passwd = '1234';
$dbname ='codecamp42254';
$err_msg = [];
$name = '';
$img = '';
$id = '';
$stock = '';
$date = '';
$change = '';


if ($link = mysqli_connect($host, $user_name, $passwd, $dbname)) {

    mysqli_set_charset($link, 'utf8');

    //購入処理判定
    //トランザクション開始
    mysqli_autocommit($link, false);

    if (isset($_POST['order_flg']) === FALSE){

        $err_msg[] = "不正なアクセスです";
    } else {

        if ($_POST['payment'] === ''){
        
            $err_msg[] = "お金を入力してください";
        } else if (is_numeric($_POST['payment']) === FALSE){

            $err_msg[] = "お金は半角数字で入力してください";
        }

        if (isset($_POST['id']) === FALSE){

            $err_msg[] = "商品を選択してください";
        }

        //POSTした値の代入と現在時刻取得
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $img = $_POST['image'];
        $date = date('Y-m-d H:i:s');

        //購入処理

    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
    </style>
</head>
<body>
<h1>自動販売機結果</h1>
<?php
for ($i = 0; $i < count($err_msg); $i++) {
    print $err_msg[$i]."<br>";
}

if  (count($err_msg) === 0){
    print "がしゃん</br>";
    print '<img src="'.$img.'">が買えました</br>';
}
?>
<a href="index.php">戻る</a>
</body>
</html>