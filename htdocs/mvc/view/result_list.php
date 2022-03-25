<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
    </style>
</head>
<body>
<h1>自動販売機結果</h1>
<?php
for ($i = 0; $i < count($err_msg); $i++) {
    print $err_msg[$i]."<br>";
}

if  (count($err_msg) === 0){
    print "がしゃん</br>";
    print '<img src="'.$image.'"></br>';
    print $name."が買えました</br>";
    print "おつりは【".$change."円】です</br>";
}
?>
<a href="index.php">戻る</a>
</body>
</html>