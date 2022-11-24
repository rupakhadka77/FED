<html>
    <body>
<?php
$myObj ='Thanks for your subscription to Ringtone UK your mobile will be charged a £5/month Please confirm by replying YES or NO. If you reply NO you will not be charged';
// $subjectVal = "It was nice sunny day.";
$obj=($myObj);
    $resStr2 = str_ireplace(' ', '_', $obj);
    // print_r($resStr2);
// $arr = explode (",", $row['user_interest']);

 $result = shell_exec('python C:/xampp/htdocs/NepsWebsite-master-latest/spamFilter.py '.($resStr2));





 echo $result
?>
    </body>
</html>