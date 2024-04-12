<?php
   include_once("header.php");
   include_once("navbar.php");
?>

<html>
<head>
<style>
    body {
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
<body>
<br>
<div class="container">
    <body>
        <?php
        // Establishing MySQLi connection
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "insertion";

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        echo "<div class='container'><table width='' class='table table-bordered' border='1'>
                            <tr>
                                <th>Faculty</th>
                                <th>Designation</th>
                                 <th>Action</th>
                            </tr>";

        $query = "SELECT * FROM faculty";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['faculty_name'] . "</td>";
                echo "<td>" . $row['designation'] . "</td>";
                echo "<td>
                        <form class='form-horizontal' method='post' action='faclist.php'>
                            <input name='faculty_id' type='hidden' value='".$row['faculty_id']."'>
                            <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }

        echo "</table>";

        // Delete record
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['faculty_id'])) {
            $faculty_id = $conn->real_escape_string($_POST['faculty_id']);
            $sql = "DELETE FROM faculty WHERE faculty_id='$faculty_id'";
            if ($conn->query($sql) === TRUE) {
                echo '<script type="text/javascript">alert("Row Successfully Deleted");location="list.php";</script>';
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }

        $conn->close();
        ?>
    </body>
</div>

<?php
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "footer.php";
   include_once("footer.php");
?>
</body>
</html>
