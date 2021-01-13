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
            else
            {
                array_push($misc_comments, $row["comments"]);
            }

            $date_search_flag = "expected ship date: ";

            //add the date to the db if a comment contains one
            if(str_contains($search_comment, $date_search_flag))
            {

                //get the index of the date by finding the position of the search flag and then adding the length of the flag
                $date_index = strpos($search_comment, $date_search_flag) + strlen($date_search_flag);

                //get the 8 chars of the date
                $date = substr($search_comment, $date_index, 8);
                
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
<hr>
    <h3>Candy Comments</h3>
    <ul>
        <?php foreach($candy_comments as $comment): ?>
            <li>
                <?php echo $comment; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>
    <h3>Call Comments</h3>
    <ul>
        <?php foreach($call_comments as $comment): ?>
            <li>
                <?php echo $comment; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>
    <h3>Referred Comments</h3>
    <ul>
        <?php foreach($referred_comments as $comment): ?>
            <li>
                <?php echo $comment; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>
    <h3>Signature Comments</h3>
    <ul>
        <?php foreach($signature_comments as $comment): ?>
            <li>
                <?php echo $comment; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>
    <h3>Miscellaneous Comments</h3>
    <ul>
        <?php foreach($misc_comments as $comment): ?>
            <li>
                <?php echo $comment; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <hr>
</body>
</html>