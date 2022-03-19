<?php
function select_DB($link) {
    
    if ($link){
        
        mysqli_set_charset($link, DB_CHARACTER_SET);

        $query = 'SELECT name, comment, date FROM bbs';
        $result = mysqli_query($link, $query);
        
        while($row = mysqli_fetch_array($result)){
            $bbs_data[] = $row;
        }
    }
    
    return array($result, $bbs_data);
}