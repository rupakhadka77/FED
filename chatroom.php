<?php 
session_start();

if(!isset($_SESSION['userId']))
{
	header('location:index.php');
}




require('database/ChatUser.php');

require('database/ChatRooms.php');
require 'includes/dbh.inc.php';


$chat_object = new ChatRooms;

$chat_data = $chat_object->get_all_chat_data();

$user_object = new ChatUser;

$user_data = $user_object->get_user_all_data();

?>

<!DOCTYPE html>
<html>

<head>
    <style>
    /* body {
        background-image: url(img/t.png) !important;
        height: auto !important;
    } */

    .card-body::-webkit-scrollbar {


        display: none;

    }

    .mt-5 .container .row {
        background-image: url("img/a.png");
        border-radius: 1rem;

    }


    .col-lg-4 {

        position: relative;
        right: -150px;

        background-color: rgb(95, 95, 95);
        border-radius: 2rem;
    }

    .details {
        color: azure;
        background-color: #556969;
        border-radius: 5rem;
        border-width: 20px;
    }

    .card {
        border-radius: 1rem !important;

    }

    .btn-sm {
        border-radius: 1rem !important;
        background-color: grey !important;

    }

    .btn-sm:hover {
        background-color: #556969 !important;
    }

    .input-group>.custom-select:not(:last-child),
    .input-group>.form-control:not(:last-child) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-radius: 1rem;
        height: 39px;
        resize: none;
    }

    .card-body {
        border-radius: 1rem;
        padding: 6px 12px;


    }






    /* .tab-content{
opacity: 0.93;
} */
    </style>



    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">




    <link rel="shortcut icon" href="img/favicon.png" />

    <title>FED Chat application using web socket programming</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor-front/bootstrap/bootstrap.min.css" rel="stylesheet">



    <link rel="stylesheet" type="text/css" href="vendor-front/parsley/parsley.css" />

    <!-- Bootstrap core JavaScript -->
    <script src="vendor-front/jquery/jquery.min.js"></script>
    <script src="vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor-front/jquery-easing/jquery.easing.min.js"></script>

    <script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
    <style type="text/css">
    html,
    body {
        height: 100%;
        width: 100vw;
        margin: 0;
    }

    #wrapper {
        display: flex;
        flex-flow: column;
        height: 100%;
    }

    #remaining {
        flex-grow: 1;
    }

    #messages {
        height: 200px;
        background: whitesmoke;
        overflow: auto;
    }

    #chat-room-frm {
        margin-top: 10px;
    }

    #user_list {
        height: 450px;
        overflow-y: auto;
    }

    #messages_area {
        height: 650px;
        overflow-y: auto;
        background-color: #e6e6e6;
    }
    </style>
</head>

<body><?php include 'includes/navbar.php'; ?>

    <div class="container" style="margin-top:100px;">

        <br />
        <!-- <h3 class="text-center">Realtime Chat using Ratchet WebSockets</h3> -->
        <br />
        <div class="row">

            <div class="col-lg-8 rounded-0">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-sm-6">
                                <h3>Chat Room</h3>
                            </div>
                            <div class="col col-sm-6 text-right">
                                <a href="users.php" class="btn btn-success btn-sm">Private Chat</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="messages_area">

                        <?php
					
					
					foreach($chat_data as $chat)
					{


						
						
						
					
						




						if(($_SESSION['userId']==$chat["userid"]))
						{
							$from = 'Me';
							$row_class = 'row justify-content-start';
							$background_class = 'text-dark alert-light';
						}
						else
						{
							$from = $chat['f_name'];
							$row_class = 'row justify-content-end';
							$background_class = 'alert-success';
						}

						echo '
						<div class="'.$row_class.'">
							<div class="col-sm-10">
								<div class="shadow-sm alert '.$background_class.'">
									<b>'.$from.' - </b>'.$chat["msg"].'
									<br />
									<div class="text-right">
										<small><i>'.$chat["created_on"].'</i></small>
									</div>
								</div>
							</div>
						</div>
						';
					}
					?>
                    </div>
                </div>

                <form method="post" id="chat_form" data-parsley-errors-container="#validation_error">
                    <div class="input-group mb-3">
                        <textarea class="form-control" id="chat_message" name="chat_message"
                            placeholder="Type Message Here..." data-parsley-maxlength="1000"
                            data-parsley-pattern="/^[a-zA-Z0-9\s]+$/" required></textarea>
                        <div class="input-group-append">
                            <button type="submit" name="send" id="send" class="btn btn-primary"><i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                    <div id="validation_error"></div>
                </form>
            </div>

            <div class="col-lg-4 mb-5">
                <?php

				// print_r($_SESSION['userId']);

				$login_user_id = '';

				// print_r($_SESSION['user_data']);

				
					$login_user_id = $_SESSION['userId'];
					
				?>
                <input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $login_user_id; ?>" />
                <div class="mt-3 mb-3 text-center">
                    <header>
                        <?php
        
        $sql ="SELECT * FROM users WHERE idUsers = {$_SESSION['userId']}";

        $stmt = mysqli_stmt_init($conn);    

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                          header("location: users.php");
                        }
                        else
                        {
                          
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            
                            $row = mysqli_fetch_assoc($result);
            }
       
          
        
        ?>

                        <img src="img/<?php echo $row['userImg']; ?>" alt="">
                        <div class="details">
                            <span><?php echo $row['f_name'] . " " . $row['l_name'] ?></span>
                            <p><?php echo $row['status']; ?></p>
                        </div>
                        <!-- <div class="theme">
        <i id="night" class="fas fa-moon"></i>
          </div> -->
                    </header>


                    <a href="edit-profile.php" class="btn btn-secondary mt-2 mb-2">Edit</a>

                </div>


                <div class="card mt-3">
                    <div class="card-header">User List</div>
                    <div class="card-body" id="user_list">
                        <div class="list-group list-group-flush">


                            <?php
    
   

    $outgoing_id = $_SESSION['userId'];
    $sql = "SELECT * FROM users WHERE NOT idUsers= {$outgoing_id} ORDER BY idUsers DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
   
	function str_openssl_dec($str, $iv)
	{
		$key = '1234567890vishal%$%^%$$#$#';
		$chiper = "AES-128-CTR";
		$options = 0;
		$str = openssl_decrypt($str, $chiper, $key, $options, $iv);
		return $str;
	}
	$mess = "";
	$iv = "";
	$msg = "";
	while ($row = mysqli_fetch_assoc($query)) {
		$sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['idUsers']}
					OR outgoing_msg_id = {$row['idUsers']}) AND (outgoing_msg_id = {$outgoing_id} 
					OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
		$query2 = mysqli_query($conn, $sql2);
		$row2 = mysqli_fetch_assoc($query2);
	
		
		if (mysqli_num_rows($query2) > 0) {
			$result = $row2['msg'];
			$v = $row2["iv"];
			$iv = hex2bin($v);
			$mess = str_openssl_dec($result, $iv);
		} else {
			$mess = "No message available";
		}
	
		if (strlen($mess) > 22) {
			$mess =  substr($mess, 0, 22) . '...';
		} 
		// else {
		//     $msg = $result;
		// }
	
		if (isset($row2['outgoing_msg_id'])) {
			($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
		} else {
			$you = "";
		}
	
		($row['status'] == "Offline") ? $offline = "offline" : $offline = "";
	
		if (($outgoing_id == $row['idUsers'])) {
			$hid_me = "hide";
		} else {
			$hid_me = "";
		};
	
		$output .= '
		<a  href="chat.php?user_id=' . $row['idUsers'] . '"class="list-group-item list-group-item-action">
			<img src="img/'.$row['userImg'].'" class="img-fluid rounded-circle img-thumbnail" width="50" />
			<span class="ml-1"><strong>'.$row['f_name'].' '.$row['l_name'].'</strong></span>
			
			
		</a>
		';
	}
	
    
    echo $output;
?>










                            <?php
						
								
							
						?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {

    var conn = new WebSocket('ws://localhost:3000');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e.data);

        var data = JSON.parse(e.data);

        var row_class = '';

        var background_class = '';

        if (data.from == 'Me') {
            row_class = 'row justify-content-start';
            background_class = 'text-dark alert-light';
        } else {
            row_class = 'row justify-content-end';
            background_class = 'alert-success';
        }

        var html_data = "<div class='" + row_class +
            "'><div class='col-sm-10'><div class='shadow-sm alert " + background_class + "'><b>" + data
            .from + " - </b>" + data.msg + "<br /><div class='text-right'><small><i>" + data.dt +
            "</i></small></div></div></div></div>";

        $('#messages_area').append(html_data);

        $("#chat_message").val("");
    };

    $('#chat_form').parsley();

    $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

    $('#chat_form').on('submit', function(event) {

        event.preventDefault();

        if ($('#chat_form').parsley().isValid()) {

            var user_id = $('#login_user_id').val();

            var message = $('#chat_message').val();

            var data = {
                userId: user_id,
                msg: message
            };

            conn.send(JSON.stringify(data));

            $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

        }

    });

    $('#logout').click(function() {

        user_id = $('#login_user_id').val();

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                user_id: user_id,
                action: 'leave'
            },
            success: function(data) {
                var response = JSON.parse(data);

                if (response.status == 1) {
                    conn.close();
                    location = 'index.php';
                }
            }
        })

    });

});
</script>
<script src="js/main.js"></script>

</div>
<?php include 'includes/fot.php'; ?>


</div>

</html>