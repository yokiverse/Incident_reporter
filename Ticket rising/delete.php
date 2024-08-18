<?php
include "connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM incident WHERE incino='$id'";
    $result = $conn->query($sql);
    if ($result == TRUE) {
        echo "Record deleted successfully";
        header("Location: insert.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();