<pre>
<?php
$rand = mt_rand(1,6);
print $rand."\n";
if($rand%2 === 0){
    print "偶数";
}else{
    print "奇数";
}
?>
</pre>