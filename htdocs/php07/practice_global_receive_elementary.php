<?php
if(isset($_POST['my_name'])===TRUE && ($_POST['my_name'])!== ''){
    print htmlspecialchars($_POST['my_name'], ENT_QUOTES, 'UTF-8');
}else{
    print '名前を入力してください';
}
?>