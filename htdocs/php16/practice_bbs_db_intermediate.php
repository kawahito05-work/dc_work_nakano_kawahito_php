<?php
$name = '';
$comment = '';
$data = '';
$date = date('Y-m-d H:i:s');
$host = 'localhost';
$username = 'codecamp42254';
$passwd = 'codecamp42254';
$dbname = 'codecamp42254';
$link = mysqli_connect($host, $username, $passwd, $dbname);


if((isset($_POST['name'])===TRUE)&&(isset($_POST['comment'])===TRUE)){
    if(($_POST['name']!=='')&&($_POST['comment']!=='')){
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        mysqli_set_charset($link, 'utf8');
        $query = 'INSERT INTO bbs_table(name, comment, date) VALUES(\''.$name.'\',\''.$comment.'\',\''.$date.'\')';
        if (mysqli_query($link, $query) === TRUE){
            print '追加成功';
        } else {
            print '追加失敗';
        }
    }
}

if (mb_strlen($name) > 20) {
    print '名前は20文字以内でお願いします';
} elseif (mb_strlen($comment) > 100) {
    print 'コメントは100文字以内でお願いします';
} else if ($name === '') {
    print '名前を入力してください';
} elseif ($comment === '') {
    print 'コメントを入力してください';
}

if ($link){
    mysqli_set_charset($link, 'utf8');
    $query = 'SELECT name, comment, date FROM bbs_table';
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)){
        $bbs_data[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="ja">
    <title></title>
</head>
<body>
    <form method="POST">
        名前　　:
        <input type="text" name="name">
        <div class="box">
        コメント:
        <input type="text" name="comment">
        </input>
        </div>
        <input type="submit" name="submit" value="送信">
    </form>
<?php foreach ($bbs_data as $read) { ?>
    <p><?php print $read[0].' '.$read[1].' '.$read[2]; ?></p>
<?php } ?>
</body>
</html>