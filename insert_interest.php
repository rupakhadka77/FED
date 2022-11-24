<?php
session_start();

if (isset($_GET['user_interest']))
{
    
    require 'includes/dbh.inc.php';
    
    
    
    
    $catid=$_GET['cat_id'];
    $interests = $_GET['user_interest'];
    $resStr2 = str_ireplace('_', ' ',$interests);
    $iduser=$_SESSION['userId'];
    echo $resStr2;
    echo $iduser;
    echo $catid;



    

                    
                    $sql = "UPDATE users "
                            . "SET  "
            
                            . "user_interest=concat(user_interest,'$resStr2,') "
                            ."WHERE idUsers=$iduser";
                    
            
                    $stmt = mysqli_stmt_init($conn);
                    
                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        // header("Location: ../edit-profile.php?error=sqlerror");
                        exit();
                    }
                    else
                    {
                        
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        

                        
                        $_SESSION['user_interest'] =$resStr2 ;

                        header("Location: topics.php?cat=$catid");
                        exit();
                    }
                
            }
            else 
            {
               // header("Location: ../edit-profile.php?error=sqlerror");
                exit();
            }
   
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
