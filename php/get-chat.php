<?php
session_start();
if (isset($_SESSION['userId'])) {
    include_once "../includes/dbh.inc.php";

               
              
                
           $sql = "SELECT * FROM users WHERE idUsers = {$_SESSION['userId']}";
           $stmt = mysqli_stmt_init($conn);    

                       if (!mysqli_stmt_prepare($stmt, $sql))
                       {
                           die('sql error');
                       }
                       else
                       {
                         
                           mysqli_stmt_execute($stmt);
                           $result = mysqli_stmt_get_result($stmt);
                           
                           $row = mysqli_fetch_assoc($result);
           
}
         
    $outgoing_id = $_SESSION['userId'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $mess = "";
    function str_openssl_dec($str, $iv)
    {
        $key = '1234567890vishal%$%^%$$#$#';
        $chiper = "AES-128-CTR";
        $options = 0;
        $str = openssl_decrypt($str, $chiper, $key, $options, $iv);
        return $str;
    }

    $sql = "SELECT * FROM messages LEFT JOIN users ON users.idUsers = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] == $outgoing_id) {
                $iv = hex2bin($row['iv']);
                $mess = str_openssl_dec($row['msg'], $iv);
                $output .= '<div class="chat outgoing">
                       
                                <div class="details">
                                    <p>' . $mess . '</p>
                                </div>
                                <img src="img/' . $row['userImg'] . '" alt="">
                                </div>';
            } else {
                $iv = hex2bin($row['iv']);
                $mess = str_openssl_dec($row['msg'], $iv);
                $output .= '<div class="chat incoming">
                                <img src="img/' . $row['userImg'] . '" alt="">
                                <div class="details">
                                    <p>' . $mess . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">Messages are end-to-end encrypted. No one outside of this chat can read them.<br>Your messages will appear here as you start chating</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}
