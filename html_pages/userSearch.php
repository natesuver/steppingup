<?php
    session_start();
    require 'functions.php';
    echo json_encode(searchUsers($_POST['searchtext']));
?>