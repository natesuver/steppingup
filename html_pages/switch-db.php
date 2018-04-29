<?php
    session_start();
    if ($_SESSION['useMongo']==0) {
        $_SESSION['useMongo'] = 1;
    }
    else {
        $_SESSION['useMongo'] = 0;
    }
    header("location:login.php");
?>