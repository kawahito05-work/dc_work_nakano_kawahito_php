<?php
$host = 'localhost';
$user_name = 'root';
$passwd = '1234';
$dbname ='codecamp42254';
$name = '';
$price = '';
$stock = '';
$create_at = '';
$update_at = '';
//$link = '';
//$link = mysqli_connect($host, $user_name, $passwd, $dbname);

if ($link = mysqli_connect($host, $user_name, $passwd, $dbname)) {

    mysqli_set_charset($link, 'utf8');

    //追加or変更
    if (isset($_REQUEST['sql_kind']) === TRUE){
        //新規商品追加処理
        if ($_REQUEST['sql_kind'] === 'insert') {

            $sql = "INSERT INTO `drink_info`(`drink_id`, `name`, `price`, `created_at`, `update_at`, `public`, `image`) 
                    VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
            print 'インサートする';
            

        }
    }
    mysqli_close($link);
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
    <h1>自動販売管理ツール</h1>
    <section>
        <form>
            <h2>新規商品追加</h2>
            <div><label>名前:<input type="text" name="new_name"></label></div>
            <div><label>値段:<input type="text" name="new_price"></label></div>
            <div><label>個数:<input type="text" name="new_stock"></label></div>
            <div><input type="file" name="new_img">
            <div>
                <select name="new_status">
                    <option value="0">非公開</option>
                    <option value="1">公開</option>
                </select>
            </div>
            <input type="hidden" name="sql_kind" value="insert">
            <div><input type="submit" value="■□■□■商品追加■□■□■"></div>
        </form>
    </section>
</body>
</html>