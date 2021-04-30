<?php
    session_start();
    $school_id = $_REQUEST["school_id"];
    $date = $_REQUEST["date"];
    $start = $_REQUEST["start"];
    $end = $_REQUEST["end"];
    
   
    
    if($school_id == "") {
        echo "No school has been chosen";        
    }
    elseif ($date == "") {
        echo "Please select a date";
        }
    elseif ($start == "") {
        echo "Please select a start time";
    }
    elseif ($end == "") {
        echo "Please select an end time";
    }    
    else {
        $db = mysqli_connect('localhost', 'root', '', 'registration'); 
        // Check connection
        if (!$db) {
          die("Connection failed: " . mysqli_connect_error());
        }
        $username = $_SESSION['username'];
        //finder skole 
        $sql = "SELECT school_name FROM workplaces WHERE id=$school_id";
        $result = mysqli_query($db, $sql);
        $school_row = mysqli_fetch_row($result);
        //indsætter workhours i db
        $sql = "INSERT INTO workhours (user, school, date, start, end) VALUES ('$username','$school_row[0]', '$date', '$start', '$end')";
        $result = mysqli_query($db, $sql);
        echo $school_row[0];
    }






?>