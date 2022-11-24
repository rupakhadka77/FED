<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Profile | FED");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    if(isset($_GET['id']))
    {
        $userid = $_GET['id'];
    }
    else
    {
        $userid = $_SESSION['userId'];
    }
    
    $sql = "select * from users where idUsers = ".$userid;
    $stmt = mysqli_stmt_init($conn);    
    
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        die('SQL error');
    }
    else
    {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
    }
    
    include 'includes/HTML-head.php';   
?>
<style>
/* body {
    background-image: url("img/trees.png");
    
} */

.container {

    opacity: 0.92;

}

.row {
    padding-top: 15px;
}

.row {
    border: 5px;
    border-top: 5px solid black;

}

.row_border {
    border-top: 0;
}

hr {
    border: 5px;
    border-top: 5px solid black;

}

.carda {
    height: 320px !important;
    width: 300px;
    border-radius: 3rem;
    margin-left: -70px;
}

.fa-pencil:before {
    content: "\f040";
    margin-left: -100px;
}
</style>

</head>

<body>

    <?php include 'includes/navbar.php'; ?>
    <div class="container" style="margin-top:80px;">
        <div class="row row_border">
            <div class="col-sm-3">

                <?php include 'includes/profile_card.php'; ?>
                <?php include 'includes/profile_interest.php'; ?>

            </div>


            <div class="col-sm-8 text-center" id="user-section">
                <img class="cover-img" src="img/user-cover.png">
                <img class="profile-img" src="uploads/<?php echo $user['userImg']; ?>">

                <?php  
                    if ($user['userLevel'] === 1)
                    {
                        echo '<img id="admin-badge" src="img/admin-badge.png">';
                    }

                    $userIntrests = explode(",", $user['user_interest']);
                  
              ?>

                <h2><?php echo ucwords($user['uidUsers']); ?></h2>
                <h2><?php 
                
                for($i=0; $i < count($userIntrests)-1; $i++){
                    // this is name of interest
                    // echo $userIntrests[$i];
                    // ---------------------------------------------------------
                    $newString  = "";
                    
                    for($j=0; $j < count($userIntrests)-1; $j++){
                        if($userIntrests[$i] != $userIntrests[$j]){
                            $newString = $newString . $userIntrests[$j].",";
                        }
                    }


                    // this is delete button
                    // echo '<a  href="Delete_interest.php?user_interest='.$newString.'">Delete</a>';
                }
                
                ?></h2>
                <h6><?php echo ucwords($user['f_name']) . " " . ucwords($user['l_name']); ?></h6>
                <h6><?php echo '<small class="text-muted">'.$user['emailUsers'].'</small>'; ?></h6>

                <?php 
                if ($user['gender'] == 'm')
                {
                    echo '<i class="fa fa-male fa-2x" aria-hidden="true" style="color: #709fea;"></i>';
                }
                else if ($user['gender'] == 'f')
                {
                    echo '<i class="fa fa-female fa-2x" aria-hidden="true" style="color: #FFA6F5;"></i>';
                }
                ?>

                <br><small><?php echo $user['headline']; ?></small>
                <br><br>
                <div class="profile-bio">
                    <small><?php echo $user['bio'];?></small>
                </div>


                <hr>
                <h3>Created Blogs</h3>
                <br><br>

                <?php
                    $sql = "select * from blogs "
                            . "where blog_by = ?";
                    $stmt = mysqli_stmt_init($conn);    

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        die('SQL error');
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, "s", $userid);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        
                        echo '<div class="container">'
                                    .'<div class="row">';
                        
                        $row = mysqli_fetch_assoc($result);
                        if(empty($row))
                        {
                            echo '<div class="col-sm-4" style="padding-bottom: 30px;"></div>
                                <div class="col-sm-4">
                                    <img class="profile-empty-img" src="img/empty.png">
                                  </div>
                                  <div class="col-sm-4" style="padding-bottom: 30px;"></div>
                                    </div>
                                  </div>';
                        }
                        else
                        {
                            do
                            {       
                                    echo '<div class="col-sm-4" style="padding-bottom: 30px;">
                                        <div class="card user-blogs">
                                            <a href="blog-page.php?id='.$row['blog_id'].'">
                                            <img class="card-img-top" src="uploads/'.$row['blog_img'].'" alt="Card image cap">
                                            <div class="card-block p-2">
                                              <p class="card-title">'.ucwords($row['blog_title']).'</p>
                                             <p class="card-text"><small class="text-muted">'
                                             .date("F jS, Y", strtotime($row['blog_date'])).'</small></p>
                                            </div>
                                            </a>
                                          </div>
                                          </div>';
                            }while ($row = mysqli_fetch_assoc($result));
                            echo '</div>'
                                    .'</div>';
                        }
                    }
              ?>

                <br><br>
                <hr>
                <h3>Created Forums</h3>
                <br><br>

                <?php
                    $sql = "select * from topics where topic_by = ?";
                    $stmt = mysqli_stmt_init($conn);    

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        die('SQL error');
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, "s", $userid);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        
                        echo '<div class="container">'
                                    .'<div class="row">';
                        
                        $row = mysqli_fetch_assoc($result);
                        if(empty($row))
                        {
                            echo '<div class="col-sm-4" style="padding-bottom: 30px;"></div>
                                <div class="col-sm-4">
                                    <img class="profile-empty-img" src="img/empty.png">
                                  </div>
                                  <div class="col-sm-4" style="padding-bottom: 30px;"></div>
                                    </div>
                                  </div>';
                        }
                        else
                        {
                            do
                            {
                                echo '<div class="col-sm-4" style="padding-bottom: 30px;">
                                        <div class="card user-blogs">
                                            <a href="posts.php?topic='.$row['topic_id'].'">
                                            <img class="card-img-top" src="img/forum-cover.png" alt="Card image cap">
                                            <div class="card-block p-2">
                                              <p class="card-title">'.ucwords($row['topic_subject']).'</p>
                                             <p class="card-text"><small class="text-muted">'
                                             .date("F jS, Y", strtotime($row['topic_date'])).'</small></p>
                                            </div>
                                            </a>
                                          </div>
                                          </div>';
                            }while ($row = mysqli_fetch_assoc($result));
                            echo '</div>'
                                    .'</div>';
                        }
                    }
              ?>

                <br><br>
                <hr>
                <h3>Participated Polls</h3>
                <br><br>


                <?php
                    $sql = "select * from poll_votes v "
                            . "join polls p on v.poll_id = p.id "
                            . "join users u on p.created_by = u.idUsers "
                            . "where v.vote_by = ?";
                    $stmt = mysqli_stmt_init($conn);    

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        die('SQL error');
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, "s", $userid);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        
                        echo '<div class="container">'
                                    .'<div class="row">';
                        
                        $row = mysqli_fetch_assoc($result);
                        if(empty($row))
                        {
                            echo '<div class="col-sm-4" style="padding-bottom: 30px;"></div>
                                <div class="col-sm-4">
                                    <img class="profile-empty-img" src="img/empty.png">
                                  </div>
                                  <div class="col-sm-4" style="padding-bottom: 30px;"></div>
                                    </div>
                                  </div>';
                        }
                        else
                        {
                            do
                            {   
                                echo '<div class="col-sm-4" style="padding-bottom: 30px;">
                                        <div class="card user-blogs">
                                            <a href="poll.php?poll='.$row['poll_id'].'">
                                            <img class="card-img-top" src="img/poll-cover.png" alt="Card image cap">
                                            <div class="card-block p-2">
                                              <p class="card-title">'.ucwords($row['subject']).'</p>
                                             <p class="card-text"><small class="text-muted">'
                                             .date("F jS, Y", strtotime($row['created'])).'</small></p>
                                            </div>
                                            </a>
                                          </div>
                                          </div>';
                            }while ($row = mysqli_fetch_assoc($result));
                            echo '</div>'
                                    .'</div>';
                        }
                    }
              ?>


                <br><br>



            </div>
            <div class="col-sm-1">

            </div>
        </div>


    </div> <!-- /container -->

    <!-- <?php include 'includes/foter.php'; ?> -->


    <?php include 'includes/HTML-footer.php'; ?>
    <script src="js/main.js"></script>