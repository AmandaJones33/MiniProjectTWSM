<?php
    $userId = $_REQUEST["userId"];
  
    
    if($userId == "") {
        return;        
    }
    else {
        $db = mysqli_connect('localhost', 'root', '', 'registration'); 
        // Check connection
        if (!$db) {
          die("Connection failed: " . mysqli_connect_error());
        }

        //finder user 
        $sql = "SELECT username FROM users WHERE id=$userId";
        $result = mysqli_query($db, $sql);
        $user_row = mysqli_fetch_row($result);

        //henter alle rækker fra den valgte user
        $sql = "SELECT * FROM workhours WHERE user='$user_row[0]'";
        
        $result = mysqli_query($db, $sql);
       
        while ($row = mysqli_fetch_row($result)) {
            
            echo '<tr>';
            echo '<td >' . $row[0] . '</td>';
            echo '<td>' . $row[1] . '</td>';
            echo '<td>' . $row[2] . '</td>';
            echo '<td>' . $row[3] . '</td>';
            echo '<td>' . $row[4] . '</td>';
            echo '</tr>';                               
                              
        }
    }






?>