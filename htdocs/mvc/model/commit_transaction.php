<?php

function commit_transaction($err_msg, $link) {

    if (count($err_msg) === 0){

        mysqli_commit($link);
    
    } else {
    
        mysqli_rollback($link);
    
    }
}