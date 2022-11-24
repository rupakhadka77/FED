<div>
    <link href="css/forum-card.css" rel="stylesheet">


    <div class="card forum-class ">
        <div class="card-body forumCard">
            <h5 class="card-title m-0 text-left">FORUM TOPICS</h5>
            <p class="description"> Check our forums for discussion.</p>
            <hr>
            <ul class="showForum text-left">
                <div>
                    <?php
                    $sql = "select cat_id, cat_name, (
                        select count(*) from topics
                        where topics.topic_cat = cat_id
                        ) as forums
                    from categories ";
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


                            echo '
                            <div class="list-names">
                            <div class="names" >
                                     
                                <a href="topics.php?cat='.$row['cat_id'].'" class="joinButton " 
                            ">'.$row['cat_name'].'</a>
                            <script>
                                    {
                                        function joinForum() {
                                            // alert("Joined Forum");
                                            window.location.href = "topics.php?cat='.$row['cat_id'].'";
                                            
                                        }
                                    }
                                    </script>

                           
                                    </div>
                                    </div>

                                    

                '; 

                        }
                    }
                ?>

                </div>

            </ul>
        </div>
    </div>
</div>