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

    //arrays to store the different types of comments
    $candy_comments = array();
    $call_comments = array();
    $referred_comments = array();
    $signature_comments = array();
    $misc_comments = array();

    //make sure data was recieved
    if($results->num_rows > 0)
    {
        while($row = $results->fetch_assoc())
        {
            //convert the comment to lower case so caps don't mess up the search
            $search_comment = strtolower($row["comments"]);

            //check if the search comment contains one of our search strings if it does
            //push it to the corresponding array, if none of the searchs find a match 
            //put the comment in the miscellaneous array
            if(str_contains($search_comment, "candy"))
            {
                array_push($candy_comments, $row["comments"]);
            }
            else if(str_contains($search_comment, "call"))
            {
                array_push($call_comments, $row["comments"]);
            }
            else if(str_contains($search_comment, "referred"))
            {
                array_push($referred_comments, $row["comments"]);
            }
            else if(str_contains($search_comment, "signature"))
            {
                array_push($signature_comments, $row["comments"]);
            }
            else if(str_contains($search_comment, "referred"))
            {
                array_push($referred_comments, $row["comments"]);
            }
            else
            {
                array_push($misc_comments, $row["comments"]);
            }
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

</body>
</html>