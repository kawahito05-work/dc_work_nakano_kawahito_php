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
$img = '';
$err_msg = [];
//$link = '';
$link = mysqli_connect($host, $user_name, $passwd, $dbname);

if ($link = mysqli_connect($host, $user_name, $passwd, $dbname)) {

    mysqli_set_charset($link, 'utf8');

    //追加or変更
    //トランザクション開始
    mysqli_autocommit($link, false);

    if (isset($_POST['sql_type']) === TRUE){
        //新規商品追加処理

        if ($_POST['sql_type'] === 'insert') {
            
            if ($_POST['name'] === ''){
                $err_msg[] = '名前を入力してください';
            } 
            if ($_POST['price'] === ''){
                $err_msg[] = '値段を入力してください';
            } 
            if ($_POST['stock'] === ''){
                $err_msg[] = '在庫を入力してください';
            } 
            if ($_FILES['userfile']['error'] !== 0){
                $err_msg[] = 'ファイルを選択してください';
            }


            $name = $_POST['name'];
            $price = $_POST['price'];
            $public = $_POST['public'];
            $date = date('Y-m-d H:i:s');


            $uploaddir = 'uploads/';
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

            echo '<pre>';
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }

            
            $file_name=md5(uniqid(rand(), true));
            $file_name .= '.jpg';

            if (count($err_msg) === 0){
                if ( rename( $uploadfile, $uploaddir . $file_name ) ) {
                    echo "ファイル名の変更に成功しました";
                    $img_data = $uploaddir . $file_name;
                } else {
                    echo "ファイル名の変更に失敗しました";
                }
            }

            //$img_data = file_get_contents($uploadfile);

            echo 'Here is some more debugging info:';
            //print $_FILES['userfile']['tmp_name'];
            print_r($_FILES);

            print "</pre>";

            $img = $_FILES['userfile']['tmp_name'];


            $sql = "INSERT INTO `drink_info`(`name`, `price`, `created_at`, `update_at`, `public`, `image`) 
                    VALUES ('".$name."','".$price."','".$date."','".$date."','".$public."','".$img_data."');";
            
            print 'インサートする'.$sql;
            //print $img;
            if (mysqli_query($link, $sql) !== TRUE) {
                $err_msg[] = 'order_detail_table: insertエラー:' . $sql;
            } 
            print '<img src="<?='.$img.'?>">';
        }
    }

    if (count($err_msg) === 0){
        mysqli_commit($link);
    } else {
        mysqli_rollback($link);
    }


    $sql = 'SELECT drink_id,name, price, image FROM drink_info';
    // クエリ実行
    if ($result = mysqli_query($link, $sql)) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $drink_list[$i]['id'] = htmlspecialchars($row['drink_id'], ENT_QUOTES, 'UTF-8');
            $drink_list[$i]['name'] = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            $drink_list[$i]['price'] = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
            $drink_list[$i]['image'] = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
            //$drink_id = htmlspecialchars($row['drink_id'], ENT_QUOTES, 'UTF-8');
            //$drink_img = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
            $i++;
        }
    } else {
        $err_msg[] = 'SQL失敗:' . $sql;
        print 'select失敗';
    }

    //print "\n";
    //print $drink_id;
    //print "test".$drink_img;

    mysqli_free_result($result);
    mysqli_close($link);
}
for ($i = 0; $i < count($err_msg); $i++) {
    print $err_msg[$i]."<br>";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
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
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <div><input type="file" name="userfile"><div>
                <select name="public">
                    <option value="0">非公開</option>
                    <option value="1">公開</option>
                </select>
            </div>
            <input type="hidden" name="sql_type" value="insert">
            <div><input type="submit" value="■□■□■商品追加■□■□■"></div>
        </form>


        <form method="post">
           <ul>
            <?php       foreach ($drink_list as $item) { ?>
               <li>
                   <!-- <span><?php print $item['id']; ?></span> 
                   <span><?php print $item['image']; ?></span> -->
                   <span><?php print '<img src="'.$item['image'].'">'; ?></span>
                   <span><?php print $item['name']; ?></span>
                   <span><?php print $item['price']; ?></span>
                   <!-- <span><div><label><input type="text" name="stock" value="<?php print $item['image']; ?>"></label></div></span> -->
               </li>
            <?php    } ?>
            <!-- <img src="uploads/2c9a0b78f71f73643638a3a64ec96704.jpg.jpg"> -->
           </ul>
       </form>

    </section>
</body>
</html>