<?php
include_once("header.php");
include_once("navbar.php");

$host = "localhost";
$username = "root";
$password = "";
$database = "insertion";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM timer";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<div class='container'><table width='' class='table table-bordered' border='1' >
            <tr>
                <th>Start time</th>
                <th>End time</th>
                <th>Action</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['start_time'] . "</td>";
        echo "<td>" . $row['end_time'] . "</td>";
        echo "<td>
            <form class='form-horizontal' method='post' action='timelist.php'>
                <input name='id' type='hidden' value='" . $row['id'] . "'>
                <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
            </form>
        </td>";
        echo "</tr>";
    }
    echo "</table></div>";
} else {
    echo "0 results";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo '<script type="text/javascript">
              alert("Schedule Successfully Deleted");
              location="tablelist.php";
          </script>';
}

if (isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $sql = "DELETE FROM timer WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "footer.php";
include_once("footer.php");
?>
