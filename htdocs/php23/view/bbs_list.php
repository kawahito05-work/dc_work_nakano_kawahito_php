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
</body>
</html>