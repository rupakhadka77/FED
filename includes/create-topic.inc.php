<?php
session_start();
if (isset($_POST['create-topic']))
{
    
    require 'dbh.inc.php';
    
    $topicSubject = $_POST['topic-subject'];
    $topicCategory = $_POST['topic-cat'];
    $postContent = $_POST['post-content'];
  
    
    if (empty($topicSubject) || empty($postContent))
    {
        header("Location: ../create-topic.php?error=emptyfields");
        exit();
    }
    else
    {
        $FileNameNew = 'forum-cover.png';
        require 'upload.inc.php';
        $sql = "insert into topics(topic_subject, topic_date, topic_cat, topic_by, forum_img) "
                . "values (?,now(),?,?,'$FileNameNew')";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../create-topic.php?error=sqlerror");
            exit();
        }
        else
        {
// .............................................spam filter..............................

 require_once '../spam/spamfilter.php';
    $text = $postContent;

    // Search in a specific blacklist (absolute paths can be used instead)
    
    $filter = new SpamFilter(['../spam/blacklists/blacklist_all.txt']);
    $result = $filter->check_text($text);
    if ($result) {
         header("Location: ../create-topic.php?error=spamerror&message=$result");
        echo "You like talking about '$result', right? Go away!";
        exit();
    }






    // Search in all available blacklists
    $filter = new SpamFilter();

    $result = $filter->check_text($text);
    if ($result) {
        // Result contains the matched word (not the matched regular expression)
        // In our example, $result will contain the value "Drugs".
        echo "There is a special place in hell reserved for people who talk about '$result' on my blog!";
    } else {

        echo "Your comment is clean from all known spam!";



//...........................................spam filter end............................................





            mysqli_stmt_bind_param($stmt, "sss", $topicSubject, $topicCategory, $_SESSION['userId']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            
            
            $topicid = mysqli_insert_id($conn);
            
            $sql = "insert into posts(post_content, post_date, post_topic, post_by) "
                    . "values (?,now(),?,?)";
            $stmt = mysqli_stmt_init($conn);
            
            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../create-topic.php?error=sqlerror");
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($stmt, "sss", $postContent, $topicid, $_SESSION['userId']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                
                header("Location: ../create-topic.php?operation=success");
            }
        }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
}
}

else
{
    header("Location: ../index.php");
    exit();
}