<pre>
<?php
$host = 'localhost';
$username = 'codecamp42254';
$passwd = 'codecamp42254';
$dbname = 'codecamp42254';
$link = mysqli_connect($host, $username, $passwd, $dbname);

//$link = mysqli_connect('localhost', 'codecamp42254', 'codecamp42254', 'codecamp42254');
//成功
if($link){
    mysqli_set_charset($link, 'utf8');
    $query = 'SELECT goods_id, goods_name, price FROM goods_table';
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)){
        print $row['goods_id'];
        print $row['goods_name'];
        print $row['price'];
        print "\n";
    }
    mysqli_free_result($result);
    mysqli_close($link);
} else {
    print 'DB接続失敗';
}
?>
</pre>