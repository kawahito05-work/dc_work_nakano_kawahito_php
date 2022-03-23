<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="tool.css">
    <title></title>
    <style></style>
</head>
<body>
    <h1>自動販売管理ツール</h1>
    <section>
        <form enctype="multipart/form-data" action="tool.php" method="POST">
            <h2>新規商品追加</h2>
            <div><label>名前:<input type="text" name="name"></label></div>
            <div><label>値段:<input type="text" name="price"></label></div>
            <div><label>個数:<input type="text" name="stock"></label></div>
            <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
            <div><input type="file" name="userfile"><div>
                <select name="public">
                    <option value="0">非公開</option>
                    <option value="1">公開</option>
                    <!-- <option value="9">テスト用</option> -->
                </select>
            </div>
            <input type="hidden" name="sql_type" value="insert">
            <div><input type="submit" value="■□■□■商品追加■□■□■"></div>
        </form>
           <table>
                <tr>
                    <td>商品画像</td>
                    <td>商品名</td>
                    <td>価格</td>
                    <td>在庫</td>
                    <td>ステータス</td>
                </tr>
                <?php       foreach ($drink_list as $item) { ?>
                    <?php
                        if ( $item['public'] === "1" ) {
                        ?>
                        <tr>
                        <?php
                        }else{
                        ?>
                        <tr class="private">
                        <?php
                        }
                        ?>
                        <td><?php print '<image src="'.$item['image'].'">'; ?></td>
                        <td><?php print $item['name']; ?></td>
                        <td><?php print $item['price']."円"; ?></td>
                        <td>
                        <form method="post">
                            <input type="text" name="stock" value="<?php print $item['stock']; ?>">
                            <input type="hidden" name="sql_type" value="update">
                            <input type="hidden" name="id" value=<?php echo $item['id']; ?>>
                            <input type="submit" value="変更">
                        </form>
                        </td>
                        <?php
                        if ( $item['public'] === "1" ){
                        ?>
                            <td>
                                <form method="post">
                                    <input type="submit" value="公開→非公開">
                                    <input type="hidden" name="public" value=0>
                                    <input type="hidden" name="id" value=<?php echo $item['id']; ?>>
                                    <input type="hidden" name="sql_type" value="update">
                                </form>
                            </td>
                        <?php
                        } else { 
                        ?>
                            <td>
                                <form method="post">
                                    <input type="submit" value="非公開→公開">
                                    <input type="hidden" name="id" value=<?php echo $item['id']; ?>>
                                    <input type="hidden" name="public" value=1>
                                    <input type="hidden" name="sql_type" value="update">
                                </form>
                                <td>
                            </td>
                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php    } ?>
            </table>
    </section>
</body>
</html>