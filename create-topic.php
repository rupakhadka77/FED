<?php

    session_start();
    include_once 'includes/dbh.inc.php';
    
    define('TITLE',"Create Forum | FED");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'includes/HTML-head.php';
?>

<link rel="stylesheet" type="text/css" href="css/comp-creation.css">

<style>
.wrap-contact2 {
    opacity: 0.9;
}
</style>
</head>

<body>

    <?php include 'includes/navbar.php'; ?>


    <div class="bg-contact2" style=" margin-top:80px;">
        <div class="container-contact2">
            <div class="wrap-contact2">
                <form class="contact2-form" method="post" action="create-topic.inc1.php" enctype="multipart/form-data">
                    <label class="btn btn-primary position-absolute mt-2 ml-2">
                        Change Cover Image <input type="file" id="imgInp" name='dp' hidden>
                    </label>
                    <img class="cover-img " id="blah" src="#">

                    <br><br><br>
                    <span class="contact2-form-title">
                        Create A Forum
                    </span>

                    <span class="text-center">
                        <?php
                                            if(isset($_GET['error']))
                                            {
                                                if($_GET['error'] == 'emptyfields')
                                                {
                                                    echo '<h5 class="text-danger">*Fill In All The Fields</h5>';
                                                }
                                                else if ($_GET['error'] == 'sqlerror')
                                                {
                                                    echo '<h5 class="text-danger">*Website Error: Contact admin to have the issue fixed</h5>';
                                                }
                                                // else if ($_GET['error'] == 'spamerror' and isset($_GET['message']))
                                                else if ($_GET['error'] == 'spamerror')
                                                {
                                                    echo '<h5 class="text-danger">*You like talking about Spam, right? Go away!</h5>';
                                                }
                                            }
                                            else if (isset($_GET['operation']) == 'success')
                                            {
                                                echo '<h5 class="text-success">*Forum successfully created</h5>';
                                            }
                                        ?>
                    </span>

                    <?php
                                        $sql = "select cat_id, cat_name from categories;";
                                        $stmt = mysqli_stmt_init($conn);    

                                        if (!mysqli_stmt_prepare($stmt, $sql))
                                        {
                                            die('sql error');
                                        }
                                        else
                                        {
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);

                                            if (mysqli_num_rows($result) == 0)
                                            {
                                                echo "<h5 class='text-center text-muted'>You cannot create a topic before the admin creates "
                                                . "some categories</h5>";
                                            }
                                            else
                                            {
                                    ?>



                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input class="input2" type="text" name="topic-subject">
                        <span class="focus-input2" data-placeholder="Forum Subject"></span>
                    </div>


                    <label>Category</label>
                    <select class="form-control" name="topic-cat">
                        <?php 
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                echo '<option value='.$row['cat_id'].'>' . $row['cat_name'] . '</option>';
                                            }
                                        ?>
                    </select><br><br>


                    <div class="wrap-input2 validate-input" data-validate="Description is required">
                        <textarea class="input2" name="post-content"></textarea>
                        <a href="create-category" class="btn btn-warning btn-lg btn-block">Create a category</a>
                        <span class="focus-input2" data-placeholder="Forum Question"></span>
                    </div>

                    <div class="container-contact2-form-btn">
                        <div class="wrap-contact2-form-btn">
                            <div class="contact2-form-bgbtn"></div>
                            <button class="contact2-form-btn" type="submit" name="create-topic">
                                Create Forum
                            </button>
                        </div>
                    </div>



                    <?php
                                            }
                                        }
                                    ?>

                    <div class="text-center">
                        <br><br><a class="btn btn-dark btn-lg btn-block" href="topics.php">
                            View Forums</a>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/creation-main.js"></script>
    <script>
    var dp = 'img/forum-cover.png';

    $('#blah').attr('src', dp);

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
    </script>
</body>

</html>