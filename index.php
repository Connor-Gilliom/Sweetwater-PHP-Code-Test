<?php

    //connect to the sweetwater database at localhost
    $conn = mysqli_connect("localhost", "root", "toor", "sweetwater");

    //stop the script if a db connection wasn't created
    if($conn->connect_error)
    {
        die("DB connection failed: " . $conn->connect_error);
    }

    //get all the rows from the sweetwater_test table
    $sql = "SELECT * FROM sweetwater_test";
    $results = $conn->query($sql);

    
    //make sure data was recieved
    if($results->num_rows > 0)
    {
        while($row = $results->fetch_assoc())
        {
            
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Test
</body>
</html>