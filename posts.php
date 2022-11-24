<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Forum | FEDs");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    if (isset($_GET['topic']))
    {
        $topic = $_GET['topic'];
    }
    else
    {
        header("Location: index.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
?> 

        <link href="css/forum-styles.css" rel="stylesheet">

<style>

body{
  background-image: url("img/tw.png");
}
.loader-wrapper{
  background-image: url("img/t.png");
}
.mt-5 .container .row{
background-image: url("img/t.png");
}
.tab-content{
opacity: 0.9;
}
.form-control{
opacity: 0.9;
}
.form-group{
    height: 50px;
}
textarea.form-control{
    height: 60px;
}



</style>

    </head>
    
<body>

<?php

   include 'includes/navbar.php';

    if (isset($_POST['submit-reply']))
    {
        $content = $_POST['reply-content'];
        
        if (!empty($content))
        {
            $sql = "insert into posts(post_content, post_date, post_topic, post_by) "
                    . "values (?,now(),?,?)";
            $stmt = mysqli_stmt_init($conn);
            
            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                die('sql error');
            }
            else
            {
                mysqli_stmt_bind_param($stmt, "sss", $content, $topic, $_SESSION['userId']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
            }
        }
    }
    
    
    $sql = "select * from topics, categories where topic_id=? "
            . "and topic_cat = cat_id";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        die('sql error');
    }
    else
    {
        mysqli_stmt_bind_param($stmt, "s", $topic);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (!($forum = mysqli_fetch_assoc($result)))
        {
            die('sql error');
        }
    }





//............................................................Filter words section...................................................................................................................................




{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');

 	$filterCount = sizeof($filterWords);
 for ($i = 0; $i < $filterCount; $i++) {
	$forum['cat_name']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $forum['cat_name']);
}
	$forum['cat_name'];
}



{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');

 	$filterCount = sizeof($filterWords);
 for ($i = 0; $i < $filterCount; $i++) {
	$forum['topic_subject']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $forum['topic_subject']);
}
	$forum['topic_subject'];
}


//.............................................................................................................................................................................................................................................

?>
    
    
    <br><Br>
    <div class="container">
    <div class="col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forums</a></li>
                <li class="breadcrumb-item"><a href="#"><?php echo ucwords($forum['cat_name']); ?></a></li>
            </ol>
        </nav>
        <div class="card post-header text-center">
            <h1><?php echo ucwords($forum['topic_subject']); ?></h1>
        </div>
    </div>
    <div class="col-sm-12">
        
            
            
            <?php
            
                $sql = "select * from posts p, users u "
                        . "where p.post_topic=? "
                        . "and p.post_by=u.idUsers "
                        . "order by p.post_id;";
                $stmt = mysqli_stmt_init($conn);    

                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    die('sql error');
                }
                else
                {
                    mysqli_stmt_bind_param($stmt, "s", $topic);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result))
                    {

                        $voted_u = false;
                        $voted_d = false;

                        $sql = "select votePost, voteBy, vote from postvotes "
                            . "where votePost=? "
                            . "and voteBy=? "
                            . "and vote=1";

                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            die('sql error');
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt, "ss", $row['post_id'], $_SESSION['userId']);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);

                            $resultCheck = mysqli_stmt_num_rows($stmt);

                            if ($resultCheck == 0)
                            {
                                $voted_u = true;
                            }
                        }

                        $sql = "select votePost, voteBy, vote from postvotes "
                            . "where votePost=? "
                            . "and voteBy=? "
                            . "and vote=-1";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            die('sql error');
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt, "ss", $row['post_id'], $_SESSION['userId']);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);

                            $resultCheck = mysqli_stmt_num_rows($stmt);

                            if ($resultCheck == 0)
                            {
                                $voted_d = true;
                            }
                        }
                        




//............................................................Filter words section...................................................................................................................................








{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');

 	$filterCount = sizeof($filterWords);
 for ($i = 0; $i < $filterCount; $i++) {
	$row['post_content']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['post_content']);
}
	$row['post_content'];
}


//.............................................................................................................................................................................................................................................
                        
                        echo '<div class="card post">  
                                <span class="date">'.date("F jS, Y", strtotime($row['post_date']))
                                .'<span class="span-post-no"></span> </span>
                                <div class="row">

                                    <div class="col-sm-3 user">
                                        <div class="text-center">
                                            <img src="uploads/'.$row['userImg'].'" class="img-fluid center-block user-img">
                                            <h3>'.$row['uidUsers'].'</h3>
                                            <small class="text-muted">'.$row['headline'].'</small><br><br>
                                            <table style="width:100%">
                                              
                                            </table>
                                            <a href="profile.php?id='.$row['idUsers'].'">
                                                <i class="fa fa-user fa-2x" aria-hidden="true"></i></a>
                                            <a href="chat.php?user_id='.$row['idUsers'].'">
                                                <i class="fa fa-envelope fa-2x" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-sm-9 post-content">
                                        <p>'.$row['post_content'].'</p>
                                            <div class="vote text-center">';
                        
                        if ( ($row['post_by']==$_SESSION['userId']) || ($_SESSION['userLevel'] == 1))
                        {
                            echo '<a href="includes/delete-post.php?topic='.$topic.'&post='.$row['post_id'].'&by='.$row['post_by'].'" >'
                                . '<i class="fa fa-trash fa-2x" aria-hidden="true"></i></a><br>';
                        }
                        
                        if ($voted_u)
                        {
                            echo "<a href='includes/post-vote.inc.php?topic=".$topic."&post=".$row['post_id']."&vote=1' >";
                        }
                        echo '<i class="fa fa-chevron-up fa-3x" aria-hidden="true"></i></a>';

                        
                        echo '<br><span class="vote-count">'.$row['post_votes'].'</span><br>';
                        
                        
                        if ($voted_d)
                        {
                            echo "<a href='includes/post-vote.inc.php?topic=".$topic."&post=".$row['post_id']."&vote=-1' >";
                        }
                        echo '<i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></a>';
                        
                        
                        echo            '</div>
                                    </div>
                                </div>
                                <span class="likes"><span class="span-post-no"></span> <span class="span-post-no"><a
                                        href="">FED Forum</a></span></span>
                            </div>';
                                            
                        $i++;
                    }
                }
            
            ?>
            
        
    </div>
    
    
    <div class="col-sm-12">
        <form method="post" action="">
            <fieldset>
                <div class="form-group">
                    <textarea name="reply-content" class="form-control" id="reply-form" rows="7" placeholder="Write Your Reply"></textarea>
                </div>
                <input type="submit" value="Submit reply" class="btn btn-lg btn-dark" name="submit-reply">
            </fieldset>
        </form>
    </div>
</div>
    
    <?php include 'includes/fot.php'; ?>
    
    
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" ></script>
    </body>
</html>