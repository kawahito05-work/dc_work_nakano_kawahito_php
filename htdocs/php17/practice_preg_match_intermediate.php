<?php
$regexp_address = '/([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+/';
$regexp_password = '/^[a-zA-Z0-9]{6,18}/';
$address = '';
$password = '';
$message = '';
$address_err = '';
$password_err = '';

if (isset($_POST['address']) === TRUE ){
    $address = $_POST['address'];

    if ($address === '' ){
        $address_err = 'メールアドレスを入力してください<br>';
    }
}

if (isset($_POST['password']) === TRUE){
    $password = $_POST['password'];
    
    if ($password === ''){
        $password_err = 'パスワードを入力してください<br>';
    }
}

if ($address !== '' || $password !== ''){
    //if (preg_match($regexp_address, $address) === 1) {
    if (preg_match($regexp_password, $password) === 1 
        && preg_match($regexp_address, $address) === 1) {
        $message = '登録完了';
    } 
    if (preg_match($regexp_address, $address) !== 1) {
        $address_err = 'メールアドレスの形式が正しくありません<br>';
    } 
    
    if (preg_match($regexp_password, $password) !== 1) {
        $password_err = 'パスワードは半角英数記号6文字以上18文字以下で入力してください';
    }
}

print $message;
print $address_err;
print $password_err;


if ($message === ''){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf8">
</head>
<body>
    <form method="POST">
        <p>メールアドレス</p>
        <input type="text" name="address">
        <p>パスワード</p>
        <input type="text" name="password"><br>
        <input type="submit" value="検索">
    </form>
</body>
</html>
<?php
 print $message;
}
?>