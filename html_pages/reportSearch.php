<?php
    session_start();
    require 'functions.php';
    echo json_encode(runReport($_POST['rptId'],$_POST['from'],$_POST['to']));
?>