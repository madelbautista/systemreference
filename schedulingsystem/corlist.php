<?php
   include_once("header.php");
   include_once("navbar.php");
?>
<html>
<head>
<style>
body {
    background-image: url();
    background-color: white;
}
th {
    text-align: center;
}
tr {
     height: 30px;
}
td {
    padding-top: 5px;
    padding-left: 20px; 
    padding-bottom: 5px;    
    height: 20px;
}
</style>
</head>
<body><br>
<div class="container">
    <body>
    <?php
     echo "<tr>
            <td>";
               // your database connection
               $host       = "localhost"; 
               $username   = "root"; 
               $password   = "";
               $database   = "insertion"; 
               
               // create connection
               $conn = new mysqli($host, $username, $password, $database);

               // check connection
               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               }

               $query = "SELECT * FROM course";
               $result = $conn->query($query);

               if ($result->num_rows > 0) {
                    echo "<div class='container'><table width='' class='table table-bordered' border='1' >
                            <tr>
                                <th>Code</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['course_code'] . "</td>";
                            echo "<td>" . $row['course_name'] . "</td>";
                            echo "<td><form class='form-horizontal' method='post' action='corlist.php'>
                                <input name='course_id' type='hidden' value='".$row['course_id']."';>
                                <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                                </form></td>";
                            echo "</tr>";
                        }
                    echo "</table>";
               } else {
                   echo "0 results";
               }

               // delete record
               if ($_SERVER['REQUEST_METHOD'] == "POST") {
                   echo '<script type="text/javascript">
                      alert("Schedule Successfully Deleted");
                      location="list.php";
                      </script>';
               }
               if (isset($_POST['course_id'])) {
                   $course_id = $conn->real_escape_string($_POST['course_id']);
                   $sql = "DELETE FROM course WHERE course_id='$course_id'";
                   if (!$conn->query($sql)) {
                       echo ("Could not delete rows: " . $conn->error);
                   }
               }

               $conn->close();
    ?>
    </td>           
    </tr>
    </div>
    </body>
    </html>
    
<?php
   include_once("footer.php");
?>
