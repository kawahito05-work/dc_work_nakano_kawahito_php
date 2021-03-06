<?php
$goods_data = [];
$order = 'ASC';
if (isset($_GET['order']) === TRUE) {
    $order = $_GET['order'];
}
$host = 'localhost';
$username = 'codecamp42254';
$passwd = 'codecamp42254';
$dbname = 'codecamp42254';
$link = mysqli_connect($host, $username, $passwd, $dbname);

if ($link) {
    mysqli_set_charset($link, 'utf8');
    $query = 'SELECT goods_name, price FROM goods_table ORDER BY price '.$order;
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)){
        $goods_data[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($link);
} else {
    print 'DB接続失敗';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>サンプル</title>
    <style>
        table, td, tr {
            border: solid black 1px;
        }
        table {
            width: 200px;
        }
    </style>
</head>
<body>
    <h1>商品一覧</h1>
    <form>
        <input type="radio" name="order" value="ASC"<?php if ($order === 'ASC') {print 'checked';} ?>>昇順
        <input type="radio" name="order" value="DESC"<?php if ($order === 'DESC') {print 'checked';} ?>>降順
    </form>
    <table>
        <tr>
            <td>商品名</td>
            <td>値段</td>
        </tr>
<?php
foreach ($goods_data as $value){
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