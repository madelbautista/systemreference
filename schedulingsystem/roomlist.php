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


</body>
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
               $password   = ""; // Replace with your actual password
               $database   = "insertion"; // Replace with your actual database name
			   
               // select database
               $conn = new mysqli($host, $username, $password, $database);
               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               }

               $query = "SELECT * FROM rooms";
               $result = $conn->query($query);
               echo "<div class='container'><table width='' class='table table-bordered' border='1' >
                       <tr>
                       <th>Rooms</th>
                       <th>Action</th>
                       </tr>";
               while($row = $result->fetch_assoc()) {
                   echo "<tr>";
                   echo "<td>" . $row['room'] . "</td>";
                   echo "<td><form class='form-horizontal' method='post' action='roomlist.php'>
                         <input name='id' type='hidden' value='".$row['id']."';>
                         <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                         </form></td>";
                   echo "</tr>";
               }
               echo "</table>";

               echo "</td>           
        </tr>";

       // delete record
       if($_SERVER['REQUEST_METHOD'] == "POST") {
           echo '<script type="text/javascript">
                      alert("Schedule Successfully Deleted");
                         location="tablelist.php";
                           </script>';
       }
       if(isset($_POST['id'])) {
           $id = $conn->real_escape_string($_POST['id']);
           $sql = "DELETE FROM rooms WHERE id='$id'";
           if($conn->query($sql) === TRUE) {
               echo "Record deleted successfully";
           } else {
               echo "Error deleting record: " . $conn->error;
           }
       }
       $conn->close();
    ?>
</fieldset>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
	
<?php
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "footer.php";
   include_once("footer.php");
?>