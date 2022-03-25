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