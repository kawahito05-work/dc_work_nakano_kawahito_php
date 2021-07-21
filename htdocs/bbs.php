<?php
$name = '';
$comment = '';
$data = '';
$log = date('Y-M-D H:i:s');
$filename = 'bbs_file.txt';


if(isset($_POST['name'])===TRUE){
    $name = $_POST['name'];
}

if(isset($_POST['comment'])===TRUE){
    $comment = $_POST['comment'];
}

//if (mb_strlen($name) > 20) {
//    print '名前は20文字以内でお願いします'."\n";
//} 
//if (mb_strlen($comment) > 100) {
//    print 'コメントは100文字以内でお願いします'."\n";
//}

//if (mb_strlen($comment) === 0) {
//    print '名前を入力してください'."\n";
//}
//if (mb_strlen($comment) === 0) {
//    print 'コメントを入力してください'."\n";
//}

//if (preg_match("/[0-9]/", $name)) {
//    echo "名前に数字が含まれています";
//}
//
//if (preg_match("/[0-9]/", $comment)) {
//    echo "コメントに数字が含まれています";
//}

if (mb_strlen($name) > 20) {
    print '名前は20文字以内でお願いします';
} elseif (mb_strlen($comment) > 100) {
    print 'コメントは100文字以内でお願いします';
//} elseif (mb_strlen($name) === 0) {
//    print '名前を入力してください';
//} elseif (mb_strlen($comment) === 0) {
//    print 'コメントを入力してください';
} else if ($name === '') {
    print '名前を入力してください';
} elseif ($comment === '') {
    print 'コメントを入力してください';
} else {
    $data = $name.' '.$comment.$log."\n";
}

if ($data !== ''){
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(($fp = fopen($filename, 'a')) !== FALSE ) {
            if(fwrite($fp, $data) === FALSE){
                print '書き込み失敗';
            }
            fclose($fp);
        }
    }
}

$history = [];

if (is_readable($filename) === TRUE) {
    if (($fp = fopen($filename, 'r')) !== FALSE) {
        while (($tmp = fgets($fp)) !== FALSE) {
            $history[] = htmlspecialchars($tmp, ENT_QUOTES, 'UTF-8');
        }
        fclose($fp);
    }
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
<?php foreach ($history as $read) { ?>
    <p><?php print $read; ?></p>
<?php } ?>
</body>
</html>