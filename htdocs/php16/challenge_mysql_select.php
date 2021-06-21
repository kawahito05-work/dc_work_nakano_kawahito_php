<?php
$emp_data = [];
$order = 'ASC';
if (isset($_GET['order']) === TRUE) {
    $order = $_GET['order'];
}
$host = 'localhost';
$username = 'codecamp42254';
$passwd = 'codecamp42254';
$dbname = 'codecamp42254';
$link = mysqli_connect($host, $username, $passwd, $dbname);

if($link){
    mysqli_set_charset($link, 'utf-8');
    $query = 'SELECT emp_id, emp_name, job, age FROM emp_table ORDER BY emp_id '.$order;
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)){
        $emp_data[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($link);
}else{
    print 'DB接続失敗';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charaset="UTF-8">
    <title></title>
    <style>
        table, td, tr {
            border: solid black 1px;
        }
        table {
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>表示する職種を選択してください</h1>
    <form>
        <input type="radio" name="order" value="ASC" <?php if ($order === 'ASC'){print 'checked';} ?>>昇順
        <input type="radio" name="order" value="DESC" <?php if ($order === 'DESC'){print 'checked';} ?>>降順
        <input type="submit" value="表示">
    </form>
    <table>
        <tr>
            <td>名前</td>
            <td>職種</td>
            <td>年齢</td>
        </tr>
<?php
foreach ($emp_data as $value){
?>
        <tr>
            <td><?php print htmlspecialchars($value['emp_id'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php print htmlspecialchars($value['emp_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php print htmlspecialchars($value['job'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php print htmlspecialchars($value['age'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
<?php
}
?>
    </table>
</body>
</html>