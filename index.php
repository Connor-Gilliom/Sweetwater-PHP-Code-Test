<?php

    //connect to the sweetwater database at localhost
    $conn = mysqli_connect("localhost", "root", "toor", "sweetwater");

    //stop the script if a db connection wasn't created
    if(!$conn)
    {
        die("DB connection failed");
    }

?>