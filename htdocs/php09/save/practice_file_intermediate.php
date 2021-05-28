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
        
        <?php foreach ($data as $read) { ?>

            <tr>
        <?php
                $pieces = explode(',', $read);
                foreach($pieces as $piece){
                //$piece = str_replace('"', '',$piece);
                //$piece = trim($piece,'"');
        ?>
            <p><td><?php print $piece; ?></td></p>
        <?php } ?>
        </tr>
        <?php } ?>
    </table>
    </body>
</html>