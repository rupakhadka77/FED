<head>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="aos/aos.css" rel="stylesheet">

    <link href="css/variables.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>

<body>

    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between ">

            <a href="index.php" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="img/200.png" alt="">
                <h1>FED</h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>

                    <li><a class="nav-link " href="forum.php">Forum</a></li>
                    <li><a class="nav-link " href="hub.php">Hub</a></li>
                    <li><a class="nav-link " href="polls.php">Polls</a></li>
                    <li><a class="nav-link " href="events.php">Events</a></li>
                    <li><a class="nav-link " href="chatroom.php">Chatroom</a></li>
                    <li class="dropdown"><a href="#"><span>Profile</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="profile.php">My Profile</a></li>
                            <li><a href="edit-profile.php">Edit Profile</a></li>
                            <li><a href="users-view.php">Find People</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link " href="contact.php">Contact</a></li>
                    <?php                 
                    include_once "dbh.inc.php";               
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
                    <li><a class="nav-link"
                            href="includes/logout.inc.php?logout_id=<?php echo $row['unique_id']; ?>">Logout</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav><!-- .navbar -->



        </div>
    </header>

    <!-- <nav class="navbar sticky-top navbar-expand-md navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="img/200.png" width="40" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-right" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mr-1">
                <li class="nav-item px-3">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-bar-chart fa-2x" aria-hidden="true"></i>
                    </a>
                </li>

                <li class="nav-item px-3">
                    <a class="nav-link" href="users.php">
                        <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="chatroom.php">
                        <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item dropdown px-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog fa-2x" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profile.php">My Profile</a>
                        <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="users-view.php">Find People</a>
                        <a class="dropdown-item" href="contact.php">Contact Us</a>
                    </div>
                </li>
                <li class="nav-item px-3">
                    <style>
                    /* .bg-light {
                        background-image: linear-gradient(to right, #3ab5b0 0%, #3d99be 31%, #56317a 100%) !important;
                        filter: blur(0.6px);
                    } */
                    </style>
                    <?php 
                
                include_once "dbh.inc.php";
          
                
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
                    <a class="nav-link" href="includes/logout.inc.php?logout_id=<?php echo $row['unique_id']; ?>">
                        <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav> -->
    <script>
    window.addEventListener('scroll', (e) => {
        const nav = document.querySelector('#header');
        if (window.pageYOffset > 0) {
            nav.classList.add("sticked");
        } else {
            nav.classList.remove("sticked");
        }
    });
    </script>
    <script src="aos/aos.js"></script>

</body>