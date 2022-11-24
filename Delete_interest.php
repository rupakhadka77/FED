<?php
session_start();

if (isset($_GET['user_interest']))
{
    
    require 'includes/dbh.inc.php';
    
    
    
    
    
    $interests = $_GET['user_interest'];
    $iduser=$_SESSION['userId'];
    echo $interests;
    echo $iduser;



    

                    
                    $sql = "UPDATE users "
                            . "SET  "
            
                            . "user_interest='$interests' "
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
                        

                        
                        $_SESSION['user_interest'] = $interests;

                        header("Location: profile.php?edit=success");
                        exit();
                    }
                
            }
            else 
            {
                header("Location: ../edit-profile.php?error=sqlerror");
                exit();
            }
   
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
