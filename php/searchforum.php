<?php
    session_start();
    include_once "../includes/dbh.inc.php";

    $outgoing_id = $_SESSION['userId'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    "select topic_id, topic_subject, topic_date, topic_cat, topic_by, userImg, idUsers, uidUsers, cat_name, (
        select sum(post_votes)
    from posts
    where post_topic = topic_id
    ) as upvotes
from topics, users, categories 
where ";
    $sql = "SELECT topic_id, topic_subject, cat_name FROM posts JOIN topics JOIN categories WHERE ( categories.cat_name LIKE '%{$searchTerm}%' OR  topic_subject LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query)> 0){
        $output = '<a href="posts.php?topic='.$row['topic_id']. '">
        '. $row['topic_subject'] .'
        </a>';
    }else{
        $output .= 'No forum found related to your search term';
    }
    echo $output;
?>