<?php
$host = 'localhost';
$user_name = 'root';
$passwd = '1234';
$dbname ='codecamp42254';
$j = 1;

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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <title>自動販売機</title>
    <style>
    </style>
</head>
<body>
    <h1>自動販売機</h1>
    <form enctype="multipart/form-data" action="result.php" method="POST">
        <div><label>金額:<input type="text" name="payment"></label></div>
            <div class="inline">
            <?php foreach($drink_list as $item) {
                    print "ここは".$j."番目";
                    if ( $j%4 === 0){
                        //print "<div class=&quot;drink&quot;>";
                        print $j."ここで折り返し";
                        print "<div>";
                    }
                ?>
                    <span><?php print '<img src="'.$item['image'].'" class="photo">'; ?></span>
                    <span><?php print $item['name']; ?></span>
                    <span><?php print $item['price']; ?></span>
                    <span><?php print '<input type="radio" name="drink_id" value="'.$item['id'].'">' ?></span>
                <?php
                    if ( $j%4 === 0){
                        print "</div>";
                    }
                    $j++;
                } ?>
            </div>
        <input type="submit" value="■□■□■商品追加■□■□■">
    </form>
    </body>
</html>