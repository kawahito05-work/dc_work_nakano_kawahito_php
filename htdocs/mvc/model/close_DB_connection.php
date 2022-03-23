<?php

function close_DB_connection($result, $link) {

    mysqli_free_result($result);
    mysqli_close($link);
}