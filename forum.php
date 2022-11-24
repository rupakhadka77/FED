<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Forum | FED");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML1-head.php';
?>


<link rel="stylesheet" type="text/css" href="css/list-page.css">
<link href="css/main.css" rel="stylesheet">

<style>
/* body {
    background-image: url("img/t.png");
    
} */

.container {
    opacity: 0.8;
}

.users {
    padding: 1px 30px;

}

.wrapper {
    top: -102px;
    left: 509px;
    border-radius: 0px;
}
</style>
</head>

<body>



    <?php include 'includes/navbar.php'; ?>


    <main role="main" class="container" style="margin-top:100px;">
        <!-- <div class=" text-center p-3">

        <a href="index.php"><img src="img/200.png"></a>
        <br>
        </div> -->
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
            <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
            <div class="lh-100">
                <h1 class="mb-0 text-white lh-100">FED Forums</h1>
                <small>Spreading Ideas</small>
            </div>
        </div>


        <!-- <div class="wrapper user-wrapper">

            <section class="users">
                <div class="search">
                    <span class="text">Search Forums</span>
                    <input type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">

                </div>

            </section>
        </div> -->




        <div class="my-3 p-3 bg-white rounded shadow"
            style="background: linear-gradient(rgba(var(--color-secondary-rgb), 0.5), rgba(var(--color-secondary-rgb), 0.8)), url('img/onfocus-content-bg.jpg') center center; ">
            <h5 class=" border-bottom border-gray text-light pb-2 mb-0">Top Categories</h5>


            <?php

            $sql = "select cat_id, cat_name, cat_description, (
                        select count(*) from topics
                        where topics.topic_cat = cat_id
                        ) as forums
                    from categories
                    order by forums desc, cat_id asc
                    LIMIT 5";
            $stmt = mysqli_stmt_init($conn);    

            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                die('SQL error');
            }
            else
            {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result))
                {





//............................................................Filter words section...................................................................................................................................




{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');

 	$filterCount = sizeof($filterWords);
 for ($i = 0; $i < $filterCount; $i++) {
	$row['cat_name']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['cat_name']);
}
	$row['cat_name'];
}



{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');

 	$filterCount = sizeof($filterWords);
 for ($i = 0; $i < $filterCount; $i++) {
	$row['cat_description']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['cat_description']);
}
	$row['cat_description'];
}


//.............................................................................................................................................................................................................................................
                    
                    echo '<a href="topics.php?cat='.$row['cat_id'].'">
                        <div class="media text-light pt-3">
                            <img src="img/forum-cover.png" alt="" class="mr-2 rounded div-img ">
                            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray ">
                              <strong class="d-block text-gray-dark">'.ucwords($row['cat_name']).'</strong></a>
                                  <br>'.$row['cat_description'].'
                            </p>
                            <span class="text-right text-warning"> 
                                Forums: '.$row['forums'].' <i class="fa fa-book" aria-hidden="true"></i><br>';
                    
                    if ($_SESSION['userLevel'] == 1)
                    {
                        echo '<a href="includes/delete-category.php?id='.$row['cat_id'].'&page=forum" >
                                <i class="fa fa-trash" aria-hidden="true" style="color: red;"></i>
                              </a>
                            </span>';
                    }
                    else
                    {
                        echo '</span>';
                    }
                    
                    echo '</div>';
                }
           }
           
           
            if ($_SESSION['userLevel'] == 1)
            {
                echo '<small class="d-block text-right mt-3">
                        <a href="create-category.php" class="btn btn-primary">Create Category</a>';
            }
            else
            {
                echo '<small class="d-block text-right mt-3">';
            }
        ?>

            <a href="categories.php" class="btn btn-info">All Categories</a>
            </small>


        </div>




        <div class="my-3 p-3 bg-white rounded shadow"
            style="background: linear-gradient(rgba(var(--color-secondary-rgb), 0.5), rgba(var(--color-secondary-rgb), 0.8)), url('img/onfocus-content-bg.jpg') center center; ">
            <h5 class="border-bottom border-gray text-light pb-2 mb-0">
                Top Forums</h5>

            <?php

            $sql = "select topic_id, topic_subject, topic_date, topic_cat, topic_by, userImg, idUsers, uidUsers, cat_name, (
                            select sum(post_votes)
                        from posts
                        where post_topic = topic_id
                        ) as upvotes
                    from topics, users, categories 
                    where topics.topic_by = users.idUsers
                    and topics.topic_cat = categories.cat_id
                    order by upvotes desc, topic_id asc 
                    LIMIT 5";
            $stmt = mysqli_stmt_init($conn);    

            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                die('SQL error');
            }
            else
            {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result))
                {






//............................................................Filter words section...................................................................................................................................

{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');

 	$filterCount = sizeof($filterWords);
 for ($i = 0; $i < $filterCount; $i++) {
	$row['topic_subject']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['topic_subject']);
}
	$row['topic_subject'];
}



//.............................................................................................................................................................................................................................................
                    
                    echo '<a href="posts.php?topic='.$row['topic_id'].'">
                        <div class="media text-light pt-3">
                            <img src="uploads/'.$row['userImg'].'" alt="" class="mr-2 rounded div-img">
                            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                              <strong class="d-block text-gray-dark">'.ucwords($row['topic_subject']).'</strong></a>
                              <span class="text-warning">'.ucwords($row['uidUsers']).'</span><br>
                              '.date("F jS, Y", strtotime($row['topic_date'])).'
                            </p>
                            <span class="text-warning text-center">
                                Upvotes:
                                    '.$row['upvotes'].'<br>';
                    
                    if ($_SESSION['userLevel'] == 1 || $_SESSION['userId'] == $row['idUsers'])
                    {
                        echo '<a href="includes/delete-forum.php?id='.$row['topic_id'].'&page=forum" >
                                <i class="fa fa-trash" aria-hidden="true" style="color: red;"></i>
                              </a>
                            </span>';
                    }
                    else
                    {
                        echo '</span>';
                    }
                    echo '</span>
                            </div>';
                }
           }
        ?>

            <small class="d-block text-right mt-3">
                <a href="create-topic.php" class="btn btn-info">Create A Forum</a>
                <a href="topics.php" class="btn btn-warning">All Forums</a>
            </small>

        </div>
    </main>

    <?php include 'includes/fot.php'; ?>
    <script src="javascript/forums.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>