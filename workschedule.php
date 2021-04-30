<?php 
include('server_workplaces.php');
include('server.php');

$username = $_SESSION['username'];

function get_schools(){    
    $db = mysqli_connect('localhost', 'root', '', 'registration'); 
    // Check connection
    if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id, school_name FROM workplaces";
    $result = mysqli_query($db, $sql);

    $rows = [];
    while ($row = mysqli_fetch_row($result)) {
        array_push($rows, $row);  
    }
    return $rows;
}

function get_workhours(){    
    $db = mysqli_connect('localhost', 'root', '', 'registration'); 
    // Check connection
    if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM workhours WHERE user='$username'";
    $result = mysqli_query($db, $sql);

    $rows = [];
    while ($row = mysqli_fetch_row($result)) {
        array_push($rows, $row);  
    }
    return $rows;
}

function is_admin(){
    $db = mysqli_connect('localhost', 'root', '', 'registration'); 
    // Check connection
    if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $is_admin = $row["admin"];
        
            return $is_admin;

        }
            
}
$is_admin = is_admin();
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign hours</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <script type="text/javascript">
        
        function validateParameters(){
            var id = document.getElementById("schoolSelect").value;
            var date = document.getElementById("date").value;
            var start = document.getElementById("start").value;
            var end = document.getElementById("end").value;

            return id !== '' && date !== '' && start !== '' && end !== '';
        };

        function prepareParameters(){
            var id = document.getElementById("schoolSelect").value;
            var date = document.getElementById("date").value;
            var start = document.getElementById("start").value;
            var end = document.getElementById("end").value;

            return "school_id=" + id + "&date=" + date + "&start=" + start + "&end=" + end;
        };

        function resetValidation(){
            document.getElementById("output").innerHTML = "";
            document.getElementById("confirm_container").style.display = "none";
        };

        function showValidationMessage(message, hideConfirm){
            var confirmButton = document.getElementById("confirm_button");
            confirmButton.classList.remove("hidden");
            if (hideConfirm) {
             confirmButton.classList.add("hidden");   
            }
            document.getElementById("output").innerHTML = message;
            document.getElementById("confirm_container").style.display = "block";
        }

        function validateHours() {
            if (!validateParameters()) {
                showValidationMessage("Please enter valid data", true);
                return;
            }
            document.getElementById("output").innerHTML = "";

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState === 4 && this.status === 200) {
                showValidationMessage(this.responseText, false);         
              }
            };
            xmlhttp.open("GET", "validate_hours.php?" + prepareParameters(), true);
            xmlhttp.send();
        };

        function confirmHours(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState === 4 && this.status === 200) {
                resetValidation();
                var table = document.getElementById("schedule");
                var node = document.createElement("tr");
                node.innerHTML = '<tr>'+
                    '<td> <?php echo $username ?> </td>'+
                    '<td>' + this.responseText + '</td>'+
                    '<td>' + document.getElementById("date").value + '</td>'+
                    '<td>' + document.getElementById("start").value + '</td>'+
                    '<td>' + document.getElementById("end").value + '</td>'+
                 '</tr>';
                table.tBodies[0].appendChild(node);

              }
            };
            xmlhttp.open("GET", "confirm_hours.php?" + prepareParameters(), true);
            xmlhttp.send();
        };
        function returnToHomepage(){
            if (<?php echo $is_admin ?>) {
                window.location.href = 'index_admin.php';
            }
            else
                window.location.href = 'indeex_employee.php';
        };
    </script>
</head>
<body>
    <div class="header">
        <h2>Your work hours</h2>
    </div>
    <form><!-- method="post" action="insert_hours.php" -->
        School name: 
        <select id="schoolSelect" onchange="resetValidation()">
            <option selected="selected" value>School</option>	
            <?php
            $schools = get_schools();

            foreach ($schools as &$item) {
                echo "<option value='$item[0]'>$item[1]</option>";
            }
            ?>

        </select>
        
        
        
<!-- Automatically post _SESSION user to database and the school from dropdown -->
    <div class="input-group">
        <label>Date</label>
        <input type="date" name="date" id="date" onchange="resetValidation()">
    </div>
    <div class="input-group">
        <label>Start time</label>
        <input type="time" name="start" id="start" onchange="resetValidation()">
    </div>
    <div class="input-group">
        <label>End time</label>
        <input type="time" name="end" id="end" onchange="resetValidation()">
    </div>
    <input class="btn" type="button" value="Submit" onclick="validateHours()">
    

    
    <input class="btn" type="button" value="Return to homepage" onclick="returnToHomepage()">
    		
    </form>
    <div id="confirm_container">
        <div id="output"></div>
        <input class="btn" id="confirm_button" type="button" value="Confirm" onclick="confirmHours()">
    </div>
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
        <tbody class="tbody">
        <?php 
        $rows = get_workhours();
        foreach ($rows as $row) {
            echo '<tr>
                    <td>' . $row[0] . '</td>
                    <td>' . $row[1] . '</td>
                    <td>' . $row[2] . '</td>
                    <td>' . $row[3] . '</td>
                    <td>' . $row[4] . '</td>
                 </tr>';
        }

         ?> 
        </tbody>      
    </table>
</body>
</html>