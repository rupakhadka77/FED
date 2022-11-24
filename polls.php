<?php

    session_start();
    require 'includes/dbh.inc.php';
    define('TITLE',"Polls | FEDs");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
?>

<link rel="stylesheet" type="text/css" href="css/list-page.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<style>
/* body {
  background-image: url("img/t.png");>
} */

.container {
    opacity: 0.9;
}
</style>
</head>

<body>

    <?php include 'includes/navbar.php'; ?>


    <main role="main" class="container" style=" margin-top:100px;">
        <!-- <div class="text-center p-3">

            <a href="index.php"><img src="img/200.png"></a>
            <br>
        </div> -->
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
            <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
            <div class="lh-100">
                <h1 class="mb-0 text-white lh-100">FED Polls</h1>
                <small>Spreading Ideas</small>
            </div>
        </div>
        <div>
            <small class="my-3 p-3 d-block text-right">
                <a href="create-poll.php" class="btn btn-info">Create A Poll</a>
            </small>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm"
            style="background: linear-gradient(rgba(var(--color-secondary-rgb), 0.5), rgba(var(--color-secondary-rgb), 0.8)), url('img/onfocus-content-bg.jpg') center center; ">

            <h5 class="border-bottom text-light border-gray pb-2 mb-0">All Polls</h5>


            <?php

            $sql = "select p.id, p.subject, p.created, p.poll_desc, p.locked, (
                        select count(*) 
                        from poll_votes v
                        where v.poll_id = p.id
                        ) as votes
                    from polls p 
                    order by votes desc";
            
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
	$row['subject'] = preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['subject']);
	 }
	$row['subject'];
}


{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');
	 $filterCount = sizeof($filterWords);
 	for ($i = 0; $i < $filterCount; $i++) {
	$row['poll_desc']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['poll_desc']);
	 }
	$row['poll_desc'];
}

//........................................................................................................................................................................................




                    echo '<a href="poll.php?poll='.$row['id'].'">
                        <div class="media text-light pt-3">
                            <img src="img/poll-cover.png" alt="" class="mr-2 rounded div-img poll-img">
                            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray ">
                              <strong class="d-block text-gray-dark">'.ucwords($row['subject']).'</strong></a>
                                  '.date("F jS, Y", strtotime($row['created'])).'
                                  <br><br>'.substr($row['poll_desc'],0,50).'...<br>
                                   <span class="text-warning" >
                                        '.$row['votes'].' User(s) have voted
                                   </span>
                            </p>
                            <span class="text-right">';
                    
                    if ($_SESSION['userLevel'] == 1)
                    {
                        echo '<a href="includes/delete-poll.inc.php?pollid='.$row['id'].'" >
                                <i class="fa fa-trash fa-2x" aria-hidden="true" style="color: red;"></i>
                              </a>';
                    }
                    
                    if($row['locked'] === 1)
                    {
                        echo '<br><span class="text-warning">[Locked Poll]</span>';
                    }
                    else
                    {
                        echo '<br><span class="text-success">[Open Poll]</span>';
                    }
                    
                    echo '</span>
                            </div>';
                }
           }
           
           
            if ($_SESSION['userLevel'] == 1)
            {
                echo '<small class="d-block text-right mt-3">
                        <a href="create-poll.php" class="btn btn-info">Create a Poll</a>';
            }
            else
            {
                echo '<small class="d-block text-right mt-3">';
            }
        ?>


            </small>


        </div>

    </main>

    <?php include 'includes/fot.php'; ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>