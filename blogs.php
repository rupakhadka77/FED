<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Blogs | FED");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
    
?>

<link rel="stylesheet" type="text/css" href="css/list-page.css">
<style>
body {
    background-image: url("img/t.png");
    >
}

.mt-5 .container .row {
    background-image: url("img/t.png");
}

.container {
    opacity: 0.9;
}
</style>
</head>

<body>

    <?php include 'includes/navbar.php'; ?>

    <main role="main" class="container" style="margin-top:80px;">


        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
            <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
            <div class="lh-100">
                <h1 class="mb-0 text-white lh-100">FED Blogs</h1>
                <small>The FED Hub</small>
            </div>
        </div>

        <div class="row mb-2">

            <?php
                    $sql = "select * from Blogs, users 
                            where blogs.blog_by = users.idUsers";
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
//...............................................................filter words......................................................................................
{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');
 	$filterCount = sizeof($filterWords);
 	for ($i = 0; $i < $filterCount; $i++) {
	$row['blog_content'] = preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['blog_content']);
 	}
	$row['blog_content'];
}

{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');
	 $filterCount = sizeof($filterWords);
 	for ($i = 0; $i < $filterCount; $i++) {
	$row['blog_title'] = preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['blog_title']);
	 }
	$row['blog_title'];
}

//........................................................................................................................................................................................



                            echo '<div class="col-md-6">
                                    <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                      <div class="card-body d-flex flex-column align-items-start">
                                        <strong class="d-inline-block mb-2 text-primary">
                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i> '.$row['blog_votes'].'

                                        </strong>
                                        <h3 class="mb-0">
                                          <a class="text-dark" href="blog-page.php?id='.$row['blog_id'].'">'.substr($row['blog_title'],0,10).'...</a>
                                        </h3>
                                        <div class="mb-1 text-muted">'.date("F jS, Y", strtotime($row['blog_date'])).'




</div>
                                        <p class="card-text mb-auto">'.substr($row['blog_content'],0,70).'...</p>

 
    
          
              
     
               
                    
                                        <a href="blog-page.php?id='.$row['blog_id'].'">Continue reading


                              </a>

                                      </div>

<a href="includes/delete-blog.php?id='.$row['blog_id'].'&page=blogs" >
                                <i class="fa fa-trash" aria-hidden="true" style="color: red;"></i></a>

       
                          
                                      <img class="card-img-right flex-auto d-none d-lg-block bloglist-cover" 
                                            src="uploads/'.$row['blog_img'].'" alt="Card image cap">
                                    </div>
		
                                
                                  </div>';
                        }
                    }
                ?>


        </div>

    </main>

    <?php include 'includes/fot.php'; ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>