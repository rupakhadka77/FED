<html>

<head>

    <link href="css/interest.css" rel="stylesheet">
</head>
<?php 
require 'includes/dbh.inc.php';
session_start();
echo $_SESSION['userId'] ;


?>

<body class="bg">
    <script>
    function myFunction() {
        document.getElementById("demo").style.background - color: #3e828e;
}
    </script>
    <section class="container">
        <div class="c-col-content">
            <div class="c-signup-content classification-new-design">
            <form id="signup-form" action="includes/update_interest.php" method='post'
                            enctype="multipart/form-data">
                    <h1 class="title">What is your interest?</h1>
                    <p class="subtitle">Select an interest to help us personalize your experience.</p>
                    <h1 style="text-align:center;">Framework</h1>
                    <?php
                
                    $sql =  "select cat_id, cat_name, (
                        select count(*) from topics
                        where topics.topic_cat = cat_id
                        ) as forums
                    from categories where cat_type='framework' ";                       
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

                           
                            ?>
                    <label id="demo" onclick="" href="" data-classification="types" class="js-submit option">
                    <!-- <input id="demo"  type="button" type="hidden" name="intid" value="<?= $row['cat_name']; ?>"/> -->
                    <input id="demo" class="chk-btn" type="checkbox" name="interest[]"
                            value="<?= $row['cat_name']; ?>">
                            
                           
                        <div class="academic">
                    

                            <div class="type"><?= $row['cat_name']; ?></div>
                            
                         

                        </div>

                    </label>



                    <?php ;
                        }
                    }
                    ?>



<h1 style="text-align:center;">Technology</h1>


<?php
                
                    $sql =  "select cat_id, cat_name, (
                        select count(*) from topics
                        where topics.topic_cat = cat_id
                        ) as forums
                    from categories where cat_type='tech' ";                       
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

                           
                            ?>
                    <label id="demo" onclick="" href="" data-classification="types" class="js-submit option">
                    <!-- <input id="demo"  type="button" type="hidden" name="intid" value="<?= $row['cat_name']; ?>"/> -->
                    <input id="demo" class="chk-btn" type="checkbox" name="interest[]"
                            value="<?= $row['cat_name']; ?>">
                            
                           
                        <div class="academic">
                    

                            <div class="type"><?= $row['cat_name']; ?></div>
                            
                         

                        </div>

                    </label>



                    <?php ;
                        }
                    }
                    ?>
<h1 style="text-align:center;">Activity</h1>


<?php
                
                    $sql =  "select cat_id, cat_name, (
                        select count(*) from topics
                        where topics.topic_cat = cat_id
                        ) as forums
                    from categories where cat_type='activity' ";                       
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

                           
                            ?>
                    <label id="demo" onclick="" href="" data-classification="types" class="js-submit option">
                    <!-- <input id="demo"  type="button" type="hidden" name="intid" value="<?= $row['cat_name']; ?>"/> -->
                    <input id="demo" class="chk-btn" type="checkbox" name="interest[]"
                            value="<?= $row['cat_name']; ?>">
                            
                           
                        <div class="academic">
                    

                            <div class="type"><?= $row['cat_name']; ?></div>
                            
                         

                        </div>

                    </label>



                    <?php ;
                        }
                    }
                    ?>
<h1 style="text-align:center;">Programming Language</h1>


<?php
                
                    $sql =  "select cat_id, cat_name, (
                        select count(*) from topics
                        where topics.topic_cat = cat_id
                        ) as forums
                    from categories where cat_type='programming_language' ";                       
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

                           
                            ?>
                    <label id="demo" onclick="" href="" data-classification="types" class="js-submit option">
                    <!-- <input id="demo"  type="button" type="hidden" name="intid" value="<?= $row['cat_name']; ?>"/> -->
                    <input id="demo" class="chk-btn" type="checkbox" name="interest[]"
                            value="<?= $row['cat_name']; ?>">
                            
                           
                        <div class="academic">
                    

                            <div class="type"><?= $row['cat_name']; ?></div>
                            
                         

                        </div>

                    </label>



                    <?php ;
                        }
                    }
                    ?>
<h1 style="text-align:center;">Programming</h1>


<?php
                
                    $sql =  "select cat_id, cat_name, (
                        select count(*) from topics
                        where topics.topic_cat = cat_id
                        ) as forums
                    from categories where cat_type='programming' ";                       
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

                           
                            ?>
                    <label id="demo" onclick="" href="" data-classification="types" class="js-submit option">
                    <!-- <input id="demo"  type="button" type="hidden" name="intid" value="<?= $row['cat_name']; ?>"/> -->
                    <input id="demo" class="chk-btn" type="checkbox" name="interest[]"
                            value="<?= $row['cat_name']; ?>">
                            
                           
                        <div class="academic">
                    

                            <div class="type"><?= $row['cat_name']; ?></div>
                            
                         

                        </div>

                    </label>



                    <?php ;
                        }
                    }
                    ?>
<h1 style="text-align:center;">Others</h1>


<?php
                
                    $sql =  "select cat_id, cat_name, (
                        select count(*) from topics
                        where topics.topic_cat = cat_id
                        ) as forums
                    from categories where cat_type='other' ";                       
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

                           
                            ?>
                    <label id="demo" onclick="" href="" data-classification="types" class="js-submit option">
                    <!-- <input id="demo"  type="button" type="hidden" name="intid" value="<?= $row['cat_name']; ?>"/> -->
                    <input id="demo" class="chk-btn" type="checkbox" name="interest[]"
                            value="<?= $row['cat_name']; ?>">
                            
                           
                        <div class="academic">
                    

                            <div class="type"><?= $row['cat_name']; ?></div>
                            
                         

                        </div>

                    </label>



                    <?php ;
                        }
                    }
                    ?>









                 

                    <br> <input type="submit" class="type-btn btn btn-light btn-lg mt-2" name="signup-submit"
                        value="Signup">

                </form>
            </div>
        </div>
    </section>
</body>

</html>