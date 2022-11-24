<html>

<body>
<?php

$myObj = 'Chrome';


// echo json_encode($data);
// Execute the python script with the JSON data
//$resu= shell_exec('C:\xampp\htdocs\jsoncom\db.py');
$result = shell_exec('python C:/xampp/htdocs/jsoncom/rm.py '.($myObj));


// Decode the result
$resultData = ($result);

// result
// id name
// 1 ladder 
// 2 test

// database query 
// product details 

// This will contain: array('status' => 'Yes!')

print_r($resultData);



?>
</body>

</html>