<?php

    session_start();
    require 'includes/dbh.inc.php';
    
    define('TITLE',"The Team | FED");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
?>


<link href="css/creator-portfolio.min.css" rel="stylesheet">
<style>
body {
    background-image: url("img/te.png");
    >
}

.container {
    opacity: 0.95;
}
</style>
</head>

<body>

    <?php include 'includes/navbar.php'; ?>


    <div class="jumbotron text-white" style="background-image: url('img/team-cover.png')">
        <div class="container">
            <h1 class="display-3">The FED Creators</h1>
            <h4>The Brains and Brawns behind all this</h4>
            <h1><a href="https://github.com/sumad">
                    <i class="fa fa-github" aria-hidden="true"></i>
                </a> &raquo;</h1>
        </div>
    </div>


    <div class="container">

        <section class="content-section" id="portfolio">

            <div class="container">

                <div class="content-section-heading text-center">
                    <h3 class="text-secondary mb-0">The Minds Behind FED</h3>
                    <h2 class="mb-5">The Team</h2>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-6">
                        <a class="portfolio-item" href="_creators/suman.php" target="_blank">
                            <span class="caption">
                                <span class="caption-content">
                                    <h2>Suman Mainali</h2>
                                    <p class="mb-0 text-white">There is another one.</p>
                                </span>
                            </span>
                            <img class="img-fluid" src="img/suman.png" alt="" width="410" height="500">
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a class="portfolio-item" href="_creators/rupa.php" target="_blank">
                            <span class="caption">
                                <span class="caption-content">
                                    <h2>Rupa Khadka</h2>
                                    <p class="mb-0 text-white">Look at left.</p>
                                </span>
                            </span>
                            <img class="img-fluid" src="img/rupa.jpg" alt="" width="410" height="400">
                        </a>
                    </div>


                    <div class="col-lg-6">
                        <a class="portfolio-item" href="_creators/rupa.php" target="_blank">
                            <span class="caption">
                                <span class="caption-content">
                                    <h2>Upama Dahal</h2>
                                    <p class="mb-0 text-white">Look down.</p>
                                </span>
                            </span>
                            <img class="img-fluid" src="img/upama.jpg" alt="" width="410" height="400">
                        </a>
                    </div>


                    <div class="col-lg-6">
                        <a class="portfolio-item" href="_creators/rupa.php" target="_blank">
                            <span class="caption">
                                <span class="caption-content">
                                    <h2>Tarjan Paudel</h2>
                                    <p class="mb-0 text-white">Look down.</p>
                                </span>
                            </span>
                            <img class="img-fluid" src="img/tarjan.jpg" alt="" width="410" height="400">
                        </a>
                    </div>


                </div>
            </div>
        </section>


    </div>

    <?php include 'includes/fot.php'; ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>