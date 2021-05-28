<?php
$filename = './zip_data_split_1.csv';
$data = [];
if (is_readable($filename) === TRUE) {
   if (($fp = fopen($filename, 'r')) !== FALSE) {
        while (($tmp = fgets($fp)) !== FALSE) {
        //while (($tmp = fgetcsv($fp)) !== FALSE) {
           $data[] = htmlspecialchars($tmp, ENT_QUOTES, 'UTF-8');
       }
       fclose($fp);
   } else {
       $data[] = 'ファイルがありません';
   }
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <link rel="stylesheet" href="style.css">
        <title></title>
        <meta charset="UTF-8">
    </head>
    <body>
    <table>
        <tr>
            <td>郵便番号</td>
            <td>都道府県</td>
            <td>市区町村</td>
            <td>町域</td>
        </tr>
        <?php foreach ($data as $read) { ?>
            <tr>
        <?php
                $read = str_replace('"', '',$read);
                $pieces = explode(',', $read);
                //$pieces = str_replace('"', '',$pieces);
        ?>
        <p><td><?php print $pieces[0]; ?></td></p>
        <?php
                //$piece = str_replace('"', '',$piece);
                //$piece = trim($piece,'"');
                for($i = 4; $i < 7;$i++){
        ?>
            <p><td><?php print $pieces[$i]; ?></td></p>
        <?php } ?>
        </tr>
        <?php } ?>
    </table>
    </body>
</html>