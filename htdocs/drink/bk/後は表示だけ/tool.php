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
//$link = mysqli_connect($host, $user_name, $passwd, $dbname);

if ($link = mysqli_connect($host, $user_name, $passwd, $dbname)) {

    mysqli_set_charset($link, 'utf8');

    //追加or変更
    //トランザクション開始
    mysqli_autocommit($link, false);

    if (isset($_POST['sql_kind']) === TRUE){
        //新規商品追加処理
        if ($_POST['sql_kind'] === 'insert') {

            $name = $_POST['name'];
            $price = $_POST['price'];
            $public = $_POST['public'];
            $date = date('Y-m-d H:i:s');
            $img = $_FILES['img'];
            //$img = 'test.jpg';
            
            //$uploaddir = '/var/www/uploads/';
            //$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

            $uploaddir = 'uploads/';
            //$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
            $uploadfile = $uploaddir.basename($_FILES['img']['name']);


            echo '<pre>';
            if (move_uploaded_file($_FILES['img']['name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
                $img_path = $uploadfile.$_FILES['img']['name'];
            } else {
                echo "Possible file upload attack!\n";
            }

            echo 'Here is some more debugging info:';
            print_r($_FILES);

            print "</pre>";

            print "^^^^".$_FILES['img']['name']."^^^^";
            print "^^^^".$uploadfile."^^^^";
            print "^^^^".$uploadfile."^^^^";

            //header('Content-type: image/jpeg');
            //readfile('test.jpg');
            //readfile($img);

            $sql = "INSERT INTO `drink_info`(`name`, `price`, `created_at`, `update_at`, `public`, `image`) 
                    VALUES ('".$name."','".$price."','".$date."','".$date."','".$public."','"."');";
            print 'インサートする'.$sql;
            //print $img;
        }
    }

    if (count($err_msg) === 0){
        mysqli_commit($link);
    } else {
        mysqli_rollback($link);
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


<?php
print $uploadfile;
$test = 'upload/test.jpg';

?>
<!-- （5）ローカルフォルダに移動した画像を画面に表示する -->
 <img src="<?php echo $test;?>" alt="">
<?php
    //print '<img src="'.$uploadfile.'" alt="">';
?>



    <h1>自動販売管理ツール</h1>
    <section>
        <form enctype="multipart/form-data" action="" method="POST">
            <h2>新規商品追加</h2>
            <div><label>名前:<input type="text" name="name"></label></div>
            <div><label>値段:<input type="text" name="price"></label></div>
            <div><label>個数:<input type="text" name="stock"></label></div>
            <div><input type="file" name="img"><div>
                <select name="public">
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