<?php
$hand = '';
$opposite = '';
if(isset($_POST['my_hand'])===TRUE){
    $hand = (int)htmlspecialchars($_POST['my_hand'], ENT_QUOTES, 'UTF-8');
    $opposite = mt_rand(1,3);
    //print $opposite;
} 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h1>じゃんけん勝負</h1>
    自分:<?php if($hand === 1){print 'グー';}else if($hand === 2){print 'チョキ';}else{print 'パー';} ?><br>
    相手:<?php if($opposite === 1){print 'グー';}else if($opposite === 2){print 'チョキ';}else{print 'パー';} ?><br>
    結果:<?php if($opposite === $hand){print 'draw!!';}else if(($hand - $opposite)=== -2 ||($hand - $opposite)=== 1){print 'lose!!';} else {print 'win!!';} ?>
    <form method="post">
    <input type="radio" name="my_hand" value="1" <?php if($hand === 1) {print 'checked';} ?>>グー
    <input type="radio" name="my_hand" value="2" <?php if($hand === 2) {print 'checked';} ?>>チョキ
    <input type="radio" name="my_hand" value="3" <?php if($hand === 3) {print 'checked';} ?>>パー
    <input type="submit" value="送信">
    </form>
</body>
</html>