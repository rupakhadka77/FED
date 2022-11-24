


<?php
require 'dbh.inc.php';
session_start();


$user_interests = $_POST['interest'];

$data_to_send = "";
foreach ($user_interests as $value) {
  $data_to_send = $data_to_send.$value.",";
  } 
  echo $_SESSION['userId'];
  echo $data_to_send;

  // $topicCategory = $idint;


                
                   $sql =  "UPDATE users SET user_interest='".$data_to_send."'  WHERE idUsers=
                    {$_SESSION['userId']} ";                       
                    $stmt = mysqli_stmt_init($conn);    

                 
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";

                        header("Location: ../index.php");
                      }
                      ?>
