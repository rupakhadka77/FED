<div class='carda card-profile text-center'>
    <img alt='' class='card-img-top card-user-cover' src='img/orange-bg.png'>
    <div class='card-block'>
        <a href='profile.php'>
            <img src='uploads/<?php echo $_SESSION["userImg"] ?>' class='card-img-profile'>
        </a>

        <div class='card-admin-badge'>
            <?php  
                  if ($_SESSION['userLevel'] == 1)
                     {
                       echo '<img id="card-admin-badge" src="img/adminbadge.png">';
                      }
                  ?>
            <div>Admin </div>
        </div>

        <a href="edit-profile.php">
            <i class="fa fa-pencil fa-2x edit-profile" aria-hidden="true"></i>
        </a>
        <h4 class='card-title'>
            <?php echo ucwords($_SESSION['userUid']); ?>
            <small class="text-muted">
                <?php echo ucwords($_SESSION['f_name']." ".$_SESSION['l_name']); ?>
            </small>
           <small class="text-muted">
                <?php 
                $name=$user['Faculty'];
                $name1=$user['major'];
                $name2=$user['Authority'];
                if ( $name!=NULL){echo 'Student',"        ".$user['Faculty'] ;} 
                if ( $name!=NULL){echo 'Teacher',"        ".$user['Faculty'] ;} 
                if ( $name!=NULL){echo 'Authorities',"  :      ".$user['Authority'] ;}
                
                 ?>
            </small>
            <br>
            <small class="text-muted">
                <?php echo $_SESSION['headline']; ?>
            </small>

        </h4>
        <!-- <h4 class="forum-title"> -->
        <!-- <?php include 'includes/forum-card.php'; ?> -->
        <!-- </h4> -->
    </div>
</div>