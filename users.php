<?php 
  session_start();
  define('TITLE',"CHAT| FED");
  include_once "includes/dbh.inc.php";
  if(!isset($_SESSION['userId'])){
    header("location: login.php");
  }
  include 'includes/HTML1-head.php';
?>
</head>

<body>



    <div class="navbar1">

        <?php include 'includes/navbar.php'; ?>


        <div class="wrapper user-wrapper" style="margin-top:50px;margin-bottom:90px;">

            <section class="users">
                <header class="heads">
                    <div class="content">
                        <?php 
           include_once "includes/dbh.inc.php";
               
              
                
           $sql = "SELECT * FROM users WHERE idUsers = {$_SESSION['userId']}";
           $stmt = mysqli_stmt_init($conn);    

                       if (!mysqli_stmt_prepare($stmt, $sql))
                       {
                           die('sql error');
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
                            <span><?php echo $row['f_name']. " " . $row['l_name'] ?></span>
                            <p><?php echo $row['status']; ?></p>
                        </div>
                    </div>

                </header>
                <div class="search">
                    <span class="text">Select an user to start chat</span>
                    <input type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">

                </div>
            </section>
        </div>
        <?php include 'includes/fot.php'; ?>


    </div>

    <script src="javascript/users.js"></script>
    <script src="js/main.js"></script>


</body>

</html>