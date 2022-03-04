<?php
$host = 'localhost';
$user_name = 'root';
$passwd = '1234';
$dbname ='codecamp42254';
$err_msg = [];
$name = '';
$image = '';
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
        
        } else if ($_POST['payment'] < 0){

            $err_msg[] = "お金は0円以上を入力してください";

        } else if ($_POST['payment'] > 10000){

            $err_msg[] = "お金は1万円以内を入力してください";

        } 

        if (isset($_POST['id']) === FALSE){

            $err_msg[] = "商品を選択してください";
        }

        if (isset($_POST['order_flg']) === TRUE && $_POST['payment'] !== '' && isset($_POST['id']) === TRUE){
            //POSTした値の代入と現在時刻取得
            $id = $_POST['id'];
            $payment = $_POST['payment'];
            //print 'imgは'.$_POST['image'];
            $date = date('Y-m-d H:i:s');

            //購入処理
            $sql = 'SELECT drink_info.name, drink_info.price, drink_info.image, drink_stock.stock 
            FROM drink_info INNER JOIN drink_stock on drink_info.drink_id = drink_stock.drink_id WHERE drink_info.drink_id = '.$id.';';

            //print $sql;

            if ($result = mysqli_query($link, $sql)) {
            
                while ($row = mysqli_fetch_assoc($result)) {
                
                    $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                    $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
                    $image = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
                    $stock = htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8');
                    $change = $payment - $price;
                }

            } else {

                $err_msg[] = 'SQL失敗:' . $sql;
                print 'select失敗'.$sql;
            }

            //↓なぜかこのエラー判定だとうまくいかない
            //if (mysqli_query($link, $sql) !== TRUE ){
            //    $err_msg[] = '在庫: selectエラー:' . $sql;
            //}

            //購入処理

            if ($change < 0) {

                $err_msg[] = "お金が足りません";

            }

            if ($stock <= 0) {

                $err_msg[] = "在庫がありません";

            } 

            $sql = "UPDATE `drink_stock` SET `stock`='".($stock-1)."' WHERE drink_id='".$id."';";

            //print $sql;

            if (mysqli_query($link, $sql) !== TRUE ){
                $err_msg[] = '在庫: updateエラー:' . $sql;
            }
        }
    }
    //コミット
    if (count($err_msg) === 0){
        mysqli_commit($link);
    } else {
        mysqli_rollback($link);
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
    print '<img src="'.$image.'"></br>';
    print $name."が買えました</br>";
    print "おつりは【".$change."円】です</br>";
}
?>
<a href="index.php">戻る</a>
</body>
</html>