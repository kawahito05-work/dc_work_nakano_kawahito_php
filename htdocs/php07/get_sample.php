<?php
if(isset($_GET['query'])===TRUE){
   $query = htmlspecialchars($_GET['query'],ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>スーパーグローバル変数使用例</title>
</head>
<body>
   <h1>検索しよう</h1>
<?php
if (isset($query)===TRUE){
?>
   <a href="https://www.google.co.jp/search?q=<?php print $query; ?>"target="_blank">「<?php print $query; ?>」をGoogleで検索する</a><br>
<?php
}
?>
   <!-- 検索文字列送信用フォーム -->
   <form method="get">
       <input type="text" name="query" value="<?php if (isset($query) === TRUE) { print $query; } ?>">
       <input type="submit" value="送信">
   </form>
</body>
</html>