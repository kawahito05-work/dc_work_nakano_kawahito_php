<?php
$gender = '';
if(isset($_POST['gender'])===TRUE){
   $gender = htmlspecialchars($_POST['gender'],ENT_QUOTES,'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ja">
   <head>
      <meta charset="UTF-8">
   </head>
<body>
<p>あなたの性別は「<?php print $gender; ?>」です</p>
   <form method="post">
       <input type="radio" name="gender" value="男" <?php if ($gender === '男') { print 'checked'; } ?>>男
       <input type="radio" name="gender" value="女" <?php if ($gender === '女') { print 'checked'; } ?>>女
       <input type="submit" value="送信">
   </form>
</body>
</html>