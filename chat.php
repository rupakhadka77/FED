<?php
session_start();
require 'includes/dbh.inc.php';
define('TITLE',"Inbox | FED");
if (!isset($_SESSION['userId'])) {
  header("location: login.php");
  exit();



}
?>
<?php

  include 'includes/HTML2-head.php';
  
 
?>
<style>
body {
    background-image: linear-gradient(-225deg, #FFFEFF 0%, #D7FFFE 100%);
}
</style>
</head>

<body>
    <div class="navbar1">
        <?php


include 'includes/navbar.php';

?>


        <div class="wrapper chating">

            <section class="chat-area" style="margin-top:20px;margin-bottom:90px;">
                <header>
                    <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql ="SELECT * FROM users WHERE idUsers = {$user_id}";

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
                    <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="img/<?php echo $row['userImg']; ?>" alt="">
                    <div class="details text-secondary">
                        <span><?php echo $row['f_name'] . " " . $row['l_name'] ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                    <!-- <div class="theme">
        <i id="night" class="fas fa-moon"></i>
          </div> -->
                </header>
                <div class="chat-box">
                </div>
                <form action="#" class="typing-area">
                    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                        autocomplete="off">
                    <button><i class="fab fa-telegram-plane"></i></button>
                </form>
            </section>

        </div>
        <?php include 'includes/fot.php'; ?>


        <!-- <script>
    let moon = document.getElementById("night");
    let sun = document.querySelector("#day");
    moon.onclick = () => {
      moon.classList.add("active");
        document.documentElement.style.setProperty('--pink-color', '#263238');
        document.querySelector(".chat-area header").style.background = "#37474F";
        document.querySelector(".chat-area header").style.color = "#fff";
    }
    sun.onclick = () => {
      moon.classList.remove("active");
        document.documentElement.style.setProperty('--pink-color', '#00838F');
        document.querySelector(".chat-area header").style.background = "#e3e3e3";
        document.querySelector(".chat-area header").style.color = "#eee";
    }

    // function changeTheme(theme) {
    //   if (theme == "night") {
       
    //   } else {
       
    //   }
    // }
  </script> -->
        <script src="javascript/chat.js"></script>
        <script src="js/main.js"></script>



</body>

</html>