<?php
$name = '';
$gender = '';
$mail = '';
if(isset($_POST['my_name'])===TRUE){
    $name = htmlspecialchars($_POST['my_name'], ENT_QUOTES, 'UTF-8');
    print 'ここに入力したお名前を表示:'.$name;
    print '<br />';
}
if(isset($_POST['gender'])===TRUE){
    $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES, 'UTF-8');
    print 'ここに選択した性別を表示:'.$gender;
    print '<br />';
}
if(isset($_POST['mail'])===TRUE){
    $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8');
    print 'ここにメールを受け取るかを表示:'.$mail;
    print '<br />';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form method="post">
    お名前:<input id="my_name" type="text" name="my_name" value=""><br>
    性別:<input type="radio" name="gender" value="man" <?php if ($gender === 'man') { print 'checked'; } ?>>男
    <input type="radio" name="gender" value="woman"<?php if ($gender === 'woman') { print 'checked'; } ?>>女<br>
    <input type="checkbox" name="mail" value="OK">お知らせメールを受け取る<br>
    <input type="submit" value="送信">
</form>
</body>
</html>