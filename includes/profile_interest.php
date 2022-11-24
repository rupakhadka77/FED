<div>
    <link href="css/forum-card.css" rel="stylesheet">


    <div class="card forum-class ">
        <div class="card-body forumCard">
            <h5 class="card-title m-0 text-left">Selected Topics</h5>
            <hr>
            <ul class="showForum text-left">
                <div>
                <?php  
                    if ($user['userLevel'] === 1)
                    {
                        echo '<img id="admin-badge" src="img/admin-badge.png">';
                    }

                    $userIntrests = explode(",", $user['user_interest']);
                  
              ?>

                
                <h5><?php 
                
                for($i=0; $i < count($userIntrests)-1; $i++){
                    // this is name of interest
                    echo $userIntrests[$i];
                    // ---------------------------------------------------------
                    $newString  = "";
                    
                    for($j=0; $j < count($userIntrests)-1; $j++){
                        if($userIntrests[$i] != $userIntrests[$j]){
                            $newString = $newString . $userIntrests[$j].",";
                        }
                    }


                    // this is delete button
                    echo '<a  href="Delete_interest.php?user_interest='.$newString.'"> <button style="padding: 0.7rem; border-radius:0.4rem;color:white;background-color:cornflowerblue;cursor:pointer;margin-left:100px;margin-bottom: 10px;">Delete</button></a>';
                }
                
                ?></h5>

                </div>

            </ul>
        </div>
    </div>
</div>