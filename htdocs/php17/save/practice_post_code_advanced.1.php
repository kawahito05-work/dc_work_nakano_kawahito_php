<?php
$regexp_zipcode = '/^[0-9]{7}/';
$err_msg = '';
$zipcode = '';
$limit = '';
$pref = '';
$address = '';
$postal_data = [];
$all_data = [];
$host = 'localhost';
$username = 'codecamp42254';
$passwd = 'codecamp42254';
$dbname = 'codecamp42254';
$link = mysqli_connect($host, $username, $passwd, $dbname);
$flag = FALSE;

//if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
    //print $_GET['page'];
    //print $_GET['pref'];
    //print $_GET['address'];
    
    $page = $_REQUEST['page'];
    $limit = "LIMIT ".($page*10 + 1).",10";
}else{
    $page = 1;
    $limit = "LIMIT 1,10";
}


$next_p = $page++; # 次のページ
$back_p = $page--; # 前のページ

if (isset($_POST['zipcode']) === TRUE){
    
    $zipcode = $_POST['zipcode'];
            
        if (preg_match($regexp_zipcode, $zipcode) !== 1){
        
            $err_msg = '郵便番号は半角数字7桁で入力してください';
        
        }else{
        
        $flag = TRUE;
        mysqli_set_charset($link, 'utf8');
        $query = "SELECT postal_code, prefecture_katakana, district_katakana,
        street_katakana, prefecture, district, street FROM postal_data WHERE postal_code = '".$zipcode."';";
        
        $result = mysqli_query($link, $query);
        
        while ($row = mysqli_fetch_array($result)){
            
            $all_data[] = $row;
            
        }
        mysqli_free_result($result);
        mysqli_close($link);
    }
}

if ((isset($_POST['pref']) === TRUE && isset($_POST['address']) === TRUE)||($page > 1)){
    
    $flag = TRUE;
    $pref = $_REQUEST['pref'];
    $address = $_REQUEST['address'];
    mysqli_set_charset($link, 'utf8');

    $query = "SELECT postal_code, prefecture_katakana, district_katakana,
              street_katakana, prefecture, district, street FROM postal_data WHERE
              prefecture = '".$pref."' AND district LIKE '%".$address."%'".$limit.";";
    //print $query;

    $result = mysqli_query($link, $query);
    
    while ($row = mysqli_fetch_array($result)){
        
        $postal_data[] = $row;
        
    }
    mysqli_free_result($result);
    
    
    $query = "SELECT postal_code, prefecture_katakana, district_katakana,
              street_katakana, prefecture, district, street FROM postal_data WHERE
              prefecture = '".$pref."' AND district LIKE '%".$address."%';";
    //print $query;
    
    $result = mysqli_query($link, $query);
    
    while ($row = mysqli_fetch_array($result)){
        
        $all_data[] = $row;
        
    }
    mysqli_free_result($result);
    
    mysqli_close($link);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>郵便番号検索</title>
    <style>
        .search_reslut {
            border-top: solid 1px;
            margin-top: 10px;
        }
        
        table {
            border-collapse: collapse;
        }
        table, tr, th, td {
            border: solid 1px;
        }
        caption {
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>郵便番号検索</h1>
    <section>
        <h2>郵便番号から検索</h2>
        <form method="POST">
            <input type="text" name="zipcode" placeholder="例）1010001" value="">
            <input type="hidden" name="page" value="">
            <input type="hidden" name="search_method" value="zipcode">
            <input type="submit" value="検索">
        </form>
        <h2>地名から検索</h2>
        <form method="POST">
            都道府県を選択
            <select name="pref">
                <option value="" selected>都道府県を選択</option>
                <option value="北海道" >北海道</option>
                <option value="青森県" >青森県</option>
                <option value="岩手県" >岩手県</option>
                <option value="宮城県" >宮城県</option>
                <option value="秋田県" >秋田県</option>
                <option value="山形県" >山形県</option>
                <option value="福島県" >福島県</option>
                <option value="茨城県" >茨城県</option>
                <option value="栃木県" >栃木県</option>
                <option value="群馬県" >群馬県</option>
                <option value="埼玉県" >埼玉県</option>
                <option value="千葉県" >千葉県</option>
                <option value="東京都" >東京都</option>
                <option value="神奈川県" >神奈川県</option>
                <option value="新潟県" >新潟県</option>
                <option value="富山県" >富山県</option>
                <option value="石川県" >石川県</option>
                <option value="福井県" >福井県</option>
                <option value="山梨県" >山梨県</option>
                <option value="長野県" >長野県</option>
                <option value="岐阜県" >岐阜県</option>
                <option value="静岡県" >静岡県</option>
                <option value="愛知県" >愛知県</option>
                <option value="三重県" >三重県</option>
                <option value="滋賀県" >滋賀県</option>
                <option value="京都府" >京都府</option>
                <option value="大阪府" >大阪府</option>
                <option value="兵庫県" >兵庫県</option>
                <option value="奈良県" >奈良県</option>
                <option value="和歌山県" >和歌山県</option>
                <option value="鳥取県" >鳥取県</option>
                <option value="島根県" >島根県</option>
                <option value="岡山県" >岡山県</option>
                <option value="広島県" >広島県</option>
                <option value="山口県" >山口県</option>
                <option value="徳島県" >徳島県</option>
                <option value="香川県" >香川県</option>
                <option value="愛媛県" >愛媛県</option>
                <option value="高知県" >高知県</option>
                <option value="福岡県" >福岡県</option>
                <option value="佐賀県" >佐賀県</option>
                <option value="長崎県" >長崎県</option>
                <option value="熊本県" >熊本県</option>
                <option value="大分県" >大分県</option>
                <option value="宮崎県" >宮崎県</option>
                <option value="鹿児島県" >鹿児島県</option>
                <option value="沖縄県" >沖縄県</option>
            </select>
            市区町村
            <input type="text" name="address" value="">
            <input type="hidden" name="search_method" value="address">
            <input type="hidden" name="page" value="">
            <input type="submit" value="検索">
        </form>
    </section>
    <section class="search_reslut">
        <p>検索結果<?php print count($all_data); ?></p>
<?php
print $err_msg;
if (empty($postal_data) === FALSE){

    if ($flag === TRUE){
    
?>
<table>
    <tr>
        <td>郵便番号</td>
        <td>都道府県</td>
        <td>市長区村</td>
        <td>町域</td>
    </tr>
<?php
            foreach ($postal_data as $value){
?>
    <tr>
        <td><?php print $value[0] ?></td>
        <td><?php print $value[4] ?></td>
        <td><?php print $value[5] ?></td>
        <td><?php print $value[6] ?></td>
    </tr>
<?php
        }
    }
?>
</table>
<?php
}
//if($now < $max_page){ // リンクをつけるかの判定
//if (count($postal_data)>10){
if ($back_p >= 0) {
    print '<a href=/php17/practice_post_code_advanced.php/?page='.($page-1).'&pref='.$pref.'&address='.$address.'>前へ</a>'. '　';
}
if ($next_p <= count($all_data)) {
    print '<a href=/php17/practice_post_code_advanced.php/?page='.($page+1).'&pref='.$pref.'&address='.$address.'>次へ</a>'. '　';
//}
//}
}
?>
    </section>
</body>
</html>