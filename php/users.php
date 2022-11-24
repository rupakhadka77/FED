<?php
    session_start();
    include_once "../includes/dbh.inc.php";

    $outgoing_id = $_SESSION['userId'];
    $sql = "SELECT * FROM users WHERE NOT idUsers= {$outgoing_id} ORDER BY idUsers DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>