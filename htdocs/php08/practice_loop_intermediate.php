<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="practice_loop_intermediate.css">
</head>
<body>
    <table id="matrix">
        <?php
        for($i = 1; $i <= 9; $i++){
        ?>
        <tr>
            <?php
            for($j = 1; $j <= 9; $j++){
            ?>
                <?php
                if ( ($i + $j) % 2 === 0){
                ?>
                <td class='odd'><?php print $i.'*'.$j.'='.$i*$j; ?></td>
                <?php
                }else{
                ?>
                <td><?php print $i.'*'.$j.'='.$i*$j; ?></td>
            <?php
                }
            }
            ?>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>