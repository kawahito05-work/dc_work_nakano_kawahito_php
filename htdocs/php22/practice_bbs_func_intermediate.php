<?php
$name = '';
$comment = '';
$data = '';
$date = date('Y-m-d H:i:s');
$host = 'localhost';
$err_msg = [];
$bbs_data = [];

$link = access_DB();

is_right_format($name, $comment);

if((isset($_POST['name'])===TRUE)&&(isset($_POST['comment'])===TRUE)){
    if(($_POST['name']!=='')&&($_POST['comment']!=='')){

        insert_DB($link);

    }
}

list($result, $bbs_data) = select_DB($link);
//$bbs_data[] = select_DB($link);
//$result = select_DB($link);

disconnect_DB($result,$link);

function select_DB($link) {
    
    if ($link){
        
        mysqli_set_charset($link, 'utf8');

        $query = 'SELECT name, comment, date FROM bbs';
        $result = mysqli_query($link, $query);
        
        while($row = mysqli_fetch_array($result)){
            $bbs_data[] = $row;
        }
    }
    //print $bbs_data[0][0];
    //return $bbs_data;
    //return $result;
    return array($result, $bbs_data);
}


function insert_DB($link){

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $date = date('Y-M-D H:i:s');
    mysqli_set_charset($link, 'utf8');

    $query = 'INSERT INTO bbs(name, comment, date) VALUES(\''.$name.'\',\''.$comment.'\',\''.$date.'\')';
    
    if (mysqli_query($link, $query) === TRUE){
        print '追加成功';
    } else {
        print '追加失敗';
    }
}

//入力チェック
function is_right_format($name,$comment){

    if (mb_strlen($name) > 20) {
    
        print '名前は20文字以内でお願いします';
    } elseif (mb_strlen($comment) > 100) {
    
        print 'コメントは100文字以内でお願いします';
    } else if ($name === '') {

        print '名前を入力してください';
    } elseif ($comment === '') {

        print 'コメントを入力してください';
    }
}

//DB接続
function access_DB() {

    $host = 'localhost';
    $username = 'root';
    $passwd = '1234';
    $dbname = 'codecamp42254';
    //$link = mysqli_connect($host, $username, $passwd, $dbname);

    return mysqli_connect($host, $username, $passwd, $dbname);
    //return $link;
}

//DB切断
function disconnect_DB($result,$link){

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
        名前　:
        <input type="text" name="name">
        <div class="box">
        コメント:
        <input type="text" name="comment">
        </input>
        </div>
        <input type="hidden" name="insert_flg" value="1">
        <input type="submit" name="submit" value="送信">
    </form>

<?php 
foreach ($bbs_data as $read) {
?>
    <p><?php print $read[0].' '.$read[1].' '.$read[2]; ?></p>
<?php 
}
?>


<!--
<?php 
foreach ($bbs_data as $read) { 
    for ($i = 0; $i < count($read); $i++) {    
?>
    <p><?php print $read[0].' '.$read[1].' '.$read[2]; ?></p>
<?php 
    }
}
?>

<?php foreach ($bbs_data as $read) { ?>
    <p><?php print $read[0][0].' '.$read[0][1].' '.$read[0][2]; ?></p>
<?php } ?>
-->
</body>
</html>