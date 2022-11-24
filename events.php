<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"Events | FED");
    
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


    <main role="main" class="container" style="margin-top:100px;">
        <!-- <div class="text-center p-3">

            <a href="index.php"><img src="img/200.png"></a>
            <br>
        </div> -->
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
            <img class="mr-3" src="img/200.png" alt="" width="48" height="48">
            <div class="lh-100">
                <h1 class="mb-0 text-white lh-100">FED Events</h1>
                <small>Spreading Ideas</small>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm"
            style="background: linear-gradient(rgba(var(--color-secondary-rgb), 0.5), rgba(var(--color-secondary-rgb), 0.8)), url('img/onfocus-content-bg.jpg') center center; ">

            <small class="d-block text-right mt-3">
                <a href="create-event.php" class="btn btn-info">Create an Event</a>
            </small>
            <h5 class="border-bottom text-light border-gray pb-2 mb-0">All Events</h5>


            <?php

            $sql = "select event_id, event_by, title, event_date, event_image
                    from events
                    order by event_date desc";
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
	$row['title']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['title']);
	 }
	$row['title'];
}

//........................................................................................................................................................................................

                    $earlier = new DateTime(date("Y-m-d"));
                    $later = new DateTime($row['event_date']);
                    if($earlier > $later)
                    {
                        $diff = '<span class="text-danger">Event Completed</span>';
                    }
                    else
                    {
                        $diff = $later->diff($earlier)->format("%a").' days remaining';
                    }
                    
                    echo '<a href="event-page.php?id='.$row['event_id'].'">
                        <div class="media text-light pt-3">
                            <img src="uploads/'.$row['event_image'].'" alt="" class="mr-2 rounded div-img">
                            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                              <strong class="d-block text-gray-dark">'.ucwords($row['title']).'</strong></a>
                              '.date("F jS, Y", strtotime($row['event_date'])).'<br>
                              <span class="text-warning" >'.$diff.'</span>
                            </p>
                            <span class="text-primary text-right">';
                    
                    if ($_SESSION['userLevel'] == 1 || $_SESSION['userId'] == $row['event_by'])
                    {
                        echo '<a href="includes/delete-event.php?id='.$row['event_id'].'&page=forum" >
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




        </div>

    </main>

    <?php include 'includes/fot.php'; ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>