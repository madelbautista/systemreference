<?php
// Database configuration
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

// Delete record if form submitted
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['subject_id'])) {
    $subject_id = $_POST['subject_id'];

    // Prepare and bind statement
    $stmt = $conn->prepare("DELETE FROM subject WHERE subject_id = ?");
    $stmt->bind_param("i", $subject_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script type="text/javascript">
                      alert("Schedule Successfully Deleted");
                         location="list.php";
                           </script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Perform SQL query to fetch subjects
$query = "SELECT * FROM subject";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Subject List</title>
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
        <table width='' class='table table-bordered' border='1'>
            <tr>
                <th>Code</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
            <?php
            // Display subjects
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['subject_code'] . "</td>";
                    echo "<td>" . $row['subject_description'] . "</td>";
                    echo "<td>
                            <form class='form-horizontal' method='post' action='sublist.php'>
                                <input name='subject_id' type='hidden' value='".$row['subject_id']."'>
                                <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No subjects found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
