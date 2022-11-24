<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Blog | FED");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    if(isset($_GET['id']))
    {
        $blogId = $_GET['id'];
    }
    else
    {
        header("Location: index.php");
        exit();
    }
    
    include 'includes/HTML-head.php'; 
?> 





<style>

body{
  background-image: url("img/tw.png");
}
.loader-wrapper{
  background-image: url("img/t.png");
}
.row{
opacity: 0.9;
}

.mt-5 .container .row{
background-image: url("img/t.png");
}



</style>

    </head>
    <body>

    <?php include 'includes/navbar.php'; ?>
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            
              <?php include 'includes/profile-card.php'; ?>
              
          </div>
            
            
          <div class="col-sm-9" id="user-section">
              
                <?php

                    $sql = "select * from blogs, users 
                            where blog_id = ? 
                            and blogs.blog_by = users.idUsers";

                    $stmt = mysqli_stmt_init($conn);    

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        die('SQL error');
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, "s", $blogId);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        $row = mysqli_fetch_assoc($result);

//............................................................Filter words section...................................................................................................................................

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

//.............................................................................................................................................................................................................................................





                    }
                ?>
              
              <img class="blog-cover" src="uploads/<?php echo $row['blog_img']; ?>">
              
              <img class="blog-author" src="uploads/<?php echo $row['userImg']; ?>">
              
              <div class="px-5">
                  
                  <br><br><br>
                  <h1><?php echo ucwords($row['blog_title']) ?></h1>
                  <br><br><br>
                  
                  <p class="text-justify"><?php echo $row['blog_content'] ?></p>
                  
                  <div class="blog-likes pr-1 pt-5">
                      
                      <h3>
                            <a href="includes/blog-vote.inc.php?blog=<?php echo $row['blog_id']; ?>" >
                                <i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
                            </a>  
                            <?php echo $row['blog_votes']; ?>
                      </h3>
                      <br>
                      <p class="text-muted">Author: <?php echo ucwords($row['uidUsers']); ?></p>
                  </div>
                  
              </div>
              
              
              
          </div>
            
        </div>


      </div> <!-- /container -->


<?php include 'includes/fot.php'; ?>



<?php include 'includes/HTML-footer.php'; ?>