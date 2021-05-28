<pre>
<?php
$second = date('s')."<br/>\n";
if($second === 00){
    print 'ジャストタイム';
} else if($second === '11' ||$second === 22 || (int)$second === 33
            || $second === '44' || $second == 55){
    print 'ゾロ目';
}
 else {
    print '外れ';
}
print 'アクセスした瞬間の秒は'.$second;
?>
</pre>