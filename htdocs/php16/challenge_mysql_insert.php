<?php
$goods_data = [];
$message = '追加する商品の名前と価格を入力してください';
$host = 'localhost';
$username = 'codecamp42254';
$passwd = 'codecamp42254';
$dbname = 'codecamp42254';
$link = mysqli_connect($host, $username, $passwd, $dbname);

if ((isset($_GET['goods_name']) === TRUE ) && (isset($_GET['goods_price']) === TRUE )){
//if (isset($_POST['name']) === TRUE ){
//if ((isset($_GET['goods_name']) === TRUE ) && (isset($_GET['goods_price']) === TRUE )){
//if (($_GET['goods_name'] !== '') && ($_GET['goods_price'] !== '')){
    $name = $_GET['goods_name'];
    $price = $_GET['goods_price'];
    //if ((is_string($name) === TRUE ) && (is_numeric($price) === TRUE)){
    if ($link) {
        mysqli_set_charset($link, 'utf8');
        $query = 'INSERT INTO goods_table(goods_name, price) VALUES (\''.$name.'\','.$price.')';
        //print $query;
        if (mysqli_query($link, $query) === TRUE){
            $message = '追加成功';
        } else {
            $message = '追加失敗';
        }
    }
}

if ($link) {
    mysqli_set_charset($link, 'utf8');
    $query = 'SELECT goods_name, price FROM goods_table';
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)){
        $goods_data[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($link);
}else{
    print 'DB接続失敗';
}
print $message;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        table, td, tr {
            border: solid black 1px;
        }
        table {
            width: 50%;;
        }
    </style>
</head>
<body>
<form>
    商品名:<input type="text" name="goods_name" >
    価格:<input type="text" name="goods_price" >
    <input type="submit" value="追加">
</form>
商品一覧
<table>
    <tr>
        <td>商品名</td>
        <td>価格</td>
    </tr>
    <?php
        foreach($goods_data as $value){
    ?>
        <tr>
            <td><?php print htmlspecialchars($value['goods_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php print htmlspecialchars($value['price'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
    <?php
    }
    ?>
</table>
</body>
</html>