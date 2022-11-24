<?php

    session_start();
    require 'includes/dbh.inc.php';
    define('TITLE',"Event | FED");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    if(isset($_GET['id']))
    {
        $eventId = $_GET['id'];
    }
    else
    {
        header("Location: index.php");
        exit();
    } 
    
    include 'includes/HTML-head.php';
?> 

        <link href="css/flipclock.css" rel="stylesheet">


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

                        $sql = "select e.event_date, e.event_id, e.event_by, e.title, e.event_image, i.description,
                                    u.uidUsers, u.userImg, i.headline as e_headline
                                from events e, event_info i, users u
                                where e.event_id = ? 
                                and e.event_by = u.idUsers
                                and e.event_id = i.event";

                        $stmt = mysqli_stmt_init($conn);    

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            die('SQL error');
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt, "s", $eventId);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            $row = mysqli_fetch_assoc($result);

                            $date1 = date_create(date("Y-m-d"));
                            $date2 = date_create($row['event_date']);

                            $diff=date_diff($date1,$date2);

                            $diff_sec = $diff->format('%r').( 
                                            ($diff->s)+ 
                                            (60*($diff->i))+ 
                                            (60*60*($diff->h))+ 
                                            (24*60*60*($diff->d))+ 
                                            (30*24*60*60*($diff->m))+ 
                                            (365*24*60*60*($diff->y)) 
                                            );      
                        }
                    ?>

                    <img class="blog-cover" src="uploads/<?php echo $row['event_image']; ?>">

                    <img class="blog-author" src="uploads/<?php echo $row['userImg']; ?>">

                    <div class="px-5">
                        <div class="text-center px-5">

                            <br><br><br>
                            <h1><?php 



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



		echo ucwords($row['title']) ?></h1>
                            <br>
                            <h6 class="text-muted"><?php 


//...............................................................filter words......................................................................................




{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');
	 $filterCount = sizeof($filterWords);
 	for ($i = 0; $i < $filterCount; $i++) {
	$row['e_headline']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['e_headline']);
	 }
	$row['e_headline'];
}

//........................................................................................................................................................................................

		echo ucwords($row['e_headline']) ?></h6>
                            <br><br><br>

                            <h3>Event Countdown</h3>
                            <br>

                            <div class="clock" style="margin-left:5%;"></div>
                            <div class="message"></div>
                            <br><br><br>

                            <p class="text-justify"><?php 


//...............................................................filter words......................................................................................




{
 	$filterWords = array('gosh', 'darn', 'poo', 'arse' , 'ass' , 'asshole', 'bastard' , 'bitch' , 'bollocks' , 'brotherfucker' , 'bugger' , 'bullshit' , 'cocksucker' , 'crap' , 'cunt' , 'damn' , 'frigger' , 'fuck' , 'hell' , 'holy shit' , 'motherfucker' , 'nigga' , 'piss' , 'prick' , 'shit' , 'slut' , 'son of a bitch' , 'twat');
	 $filterCount = sizeof($filterWords);
 	for ($i = 0; $i < $filterCount; $i++) {
	$row['description']= preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $row['description']);
	 }
	$row['description'];
}

//........................................................................................................................................................................................

		echo $row['description'] ?></p>

                            <br><br>
                            <p class="text-muted text-left">Organized By: <?php echo ucwords($row['uidUsers']); ?></p>
<small class="d-block text-right mt-3">
                <a href="create-event.php" class="btn btn-primary">Create a Event</a>
                <a href="events.php" class="btn btn-primary">All Event</a>
            </small>

                        </div>
                    </div>
                </div>
            </div>
        </div> 


<?php include 'includes/fot.php'; ?>
        

        
        <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
        <script src="js/flipclock.js"></script>	
        
        <script type="text/javascript">
		var clock;
		
		$(document).ready(function() {
			var clock;

			clock = $('.clock').FlipClock({
		        clockFace: 'DailyCounter',
		        autoStart: false,
		        callbacks: {
		        	stop: function() {
		        		$('.message').html('<br><h1 class="text-success">The Event is Happening!</h1>')
		        	}
		        }
		    });
				    
		    clock.setTime(<?php echo $diff_sec ?>);
		    clock.setCountdown(true);
		    clock.start();

		});
	</script>
        
    </body>
</html>