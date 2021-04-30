<?php
    $id = $_REQUEST["id"];
    
    if($id == "") {
        echo "Ingen skole er valgt!";        
    }    
    else {
        $db = mysqli_connect('localhost', 'root', '', 'registration'); 
        // Check connection
        if (!$db) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT school_name FROM workplaces where id = $id";
        $result = mysqli_query($db, $sql);

        $row = mysqli_fetch_row($result);

        echo "Du har valgt $row[0] med id $id";
    }
?>