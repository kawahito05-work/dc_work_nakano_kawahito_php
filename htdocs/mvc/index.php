<?php

//$j = 1;

//$link = mysqli_connect($host,$user_name,$passwd,$dbname);

if ($link = mysqli_connect($host, $user_name, $passwd, $dbname)) {

    mysqli_set_charset($link,'utf8');

    $sql = "SELECT drink_info.drink_id, drink_info.name, drink_info.price , drink_info.image ,drink_stock.stock
            FROM drink_info INNER JOIN drink_stock on drink_info.drink_id = drink_stock.drink_id WHERE drink_info.public = '1';";
    //print $sql;
    //print 'select失敗'.$sql;
    // クエリ実行
    if ($result = mysqli_query($link, $sql)){

        $i = 0;

        while ($row = mysqli_fetch_assoc($result)) {
        
            $drink_list[$i]['id'] = htmlspecialchars($row['drink_id'],ENT_QUOTES,'UTF-8');
            $drink_list[$i]['name'] = htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8');
            $drink_list[$i]['price'] = htmlspecialchars($row['price'],ENT_QUOTES,'UTF-8');
            $drink_list[$i]['image'] = htmlspecialchars($row['image'],ENT_QUOTES,'UTF-8');
            $drink_list[$i]['stock'] = htmlspecialchars($row['stock'],ENT_QUOTES,'UTF-8');
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
            <table>
                <?php 
                foreach($drink_list as $index => $item) {
                if ( $index%4 === 0){
                    print "<tr>";
                }
                ?>
                    <td>
                        <ul>
                            <li><?php print '<img src="'.$item['image'].'">'; ?></li>
                            <li><?php print $item['name']; ?></li>
                            <li><?php print $item['price']."円"; ?></li>
                            <!--
                            <input type="hidden" name="id" value=<?php echo $item['id']; ?>>
                            -->
                            <!--
                            <input type="hidden" name="name" value=<?php echo $item['name']; ?>>
                            <input type="hidden" name="price" value=<?php echo $item['price']; ?>>
                            <input type="hidden" name="stock" value=<?php echo $item['stock']; ?>>
                            <input type="hidden" name="image" value=<?php echo $item['image']; ?>>
                            -->
                            <?php
                            if ($item['stock'] >= 1){
                            ?>
                            <li><?php print '<input type="radio" name="id" value="'.$item['id'].'">'; ?></li>
                            <?php
                            }else{
                            ?>
                            <li class="sold">売り切れ<li>
                            <?php
                            }
                            ?>
                        </ul>
                    </td>
                <?php
                    if ( $index%4 === 3 ){
                        print "</tr>";
                    }
                } ?>
            </table>
        <input type="hidden" name="order_flg" value=1>
        <input type="submit" value="■□■□■購入■□■□■">
    </form>
    </body>
</html>