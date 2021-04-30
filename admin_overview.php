<?php 
include('server_workplaces.php');
include('server.php');



if (empty($_SESSION['username'])) {
        header('location: login.php');
    }

$username = $_SESSION['username'];


function get_users(){    
    $db = mysqli_connect('localhost', 'root', '', 'registration'); 
    // Check connection
    if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id, username FROM users";
    $result = mysqli_query($db, $sql);

    $rows = [];
    while ($row = mysqli_fetch_row($result)) {
        array_push($rows, $row);  
    }
    return $rows;
}

 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Overview</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <script type="text/javascript">

        function fetchHours(){
            var userId = document.getElementById('userSelect').value;
            var table = document.getElementById("schedule");
            if (userId === "") {
                table.tBodies[0].innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState === 4 && this.status === 200) {
               table.tBodies[0].innerHTML = this.responseText;
              }
            };
            xmlhttp.open("GET", "fetch_hours.php?userId=" + userId, true);
            xmlhttp.send();
        };
    </script>
</head>
<body>
    <div class="header">
        <h2>Employee workhours</h2>
    </div>
    <form>
        Employee: 
        <select id="userSelect" onchange="fetchHours()">
            <option selected="selected" value>Employee</option>	
            <?php
            $getUsers = get_users();

            foreach ($getUsers as &$item) {
                echo "<option value='$item[0]'>$item[1]</option>";
            }
            ?>

        </select>
    
    <div class="input-group">
        <p>
            Return to homepage: <a href="index_admin.php">Back</a>
        </p>
    </div>		
    </form>

    <table id="schedule">
        <thead>
        <tr>
            <th>User</th>
            <th>School</th>
            <th>Date</th>
            <th>Start</th>
            <th>End</th>
        </tr> 
        </thead>
        <tbody>
        
        </tbody>      
    </table>
</body>
</html>