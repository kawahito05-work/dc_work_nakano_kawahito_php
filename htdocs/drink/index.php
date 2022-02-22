<?php
$host = 'localhost';
$user_name = 'root';
$passwd = '1234';
$dbname ='codecamp42254';

$link = mysqli_connect($host,$user_name,$passwd,$dbname);

if ($link = mysqli_connect($host, $user_name, $passwd, $dbname)) {

    mysqli_set_charset($link,'utf8');

    $sql = 'SELECT drink_info.drink_id, drink_info.name, drink_info.price , drink_info.image 
            FROM drink_info INNER JOIN drink_stock on drink_info.drink_id = drink_stock.drink_id;';

    //print 'select失敗'.$sql;
    // クエリ実行
    if ($result = mysqli_query($link, $sql)){

        $i = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $drink_list[$i]['id'] = htmlspecialchars($row['drink_id'],ENT_QUOTES,'UTF-8');
            $drink_list[$i]['name'] = htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8');
            $drink_list[$i]['price'] = htmlspecialchars($row['price'],ENT_QUOTES,'UTF-8');
            $drink_list[$i]['image'] = htmlspecialchars($row['image'],ENT_QUOTES,'UTF-8');
            $i++;
        }

    } else {

        $err_msg[] = 'SQL失敗:' . $sql;
        print 'select失敗'.$sql;
    }

    mysqli_free_result($result);
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <title>自動販売機</title>
    <style>
    </style>
</head>
<body>
    <h1>自動販売機</h1>
    <form enctype="multipart/form-data" action="result.php" method="POST">
        <div><label>金額:<input type="text" name="payment"></label></div>
        <?php foreach($drink_list as $item) { ?>
            <td>
                <!-- <div><?php print '<img src="'.$item['image'].'">'; ?></div>
                <div><?php print $item['name'] ?></div> -->
                <span class="img_size"><?php print '<img src="'.$item['image'].'">'; ?></span>
                <span><?php print $item['name']; ?></span>
                <span><?php print $item['price']; ?></span>
            </td>
        <?php } ?>
        <input type="submit" value="■□■□■商品追加■□■□■">
    </form>
    </body>
</html>