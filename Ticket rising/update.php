<?php
include "connect.php";

if (isset($_GET['id'])) {
    $incident_no = $_GET['id'];

    // Fetch the existing record
    $sql = "SELECT * FROM incident WHERE incino = '$incident_no'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found";
        exit;
    }
}

if (isset($_POST['update'])) {
    $Reported_By = $_POST['name'];
    $Date_Of_Report = $_POST['dor'];
    $Title = $_POST['title'];
    $Incident_Type = $_POST['incitype'];
    $Date_Of_Incident = $_POST['incidate'];
    $Location = $_POST['locate'];
    $City = $_POST['city'];
    $State = $_POST['state'];
    $Zip_Code = $_POST['zip'];
    $Incident_Des = $_POST['incides'];
    $Follow_Up_Act = $_POST['act'];

    $sql = "UPDATE incident SET 
            name='$Reported_By', 
            dor='$Date_Of_Report', 
            title='$Title', 
            incitype='$Incident_Type', 
            incidate='$Date_Of_Incident', 
            locate='$Location', 
            city='$City', 
            state='$State', 
            zip='$Zip_Code', 
            incides='$Incident_Des', 
            act='$Follow_Up_Act' 
            WHERE incino='$incident_no'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: insert.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <table width="100%">
            <tr>
                <td><label>REPORTED BY:</label></td>
                <td><input type="text" name="name" value="<?php echo $row['name']; ?>"></td>
                <td><label>DATE OF REPORT:</label></td>
                <td><input type="datetime-local" name="dor" value="<?php echo $row['dor']; ?>"></td>
            </tr>
            <tr>
                <td><label>TITLE/ROLE:</label></td>
                <td><input type="text" name="title" value="<?php echo $row['title']; ?>"></td>
                <td><label>INNCIDENT NO.:</label></td>
                <td><input type="text" name="incino" value="<?php echo $row['incino']; ?>" readonly></td>
            </tr>
        </table>
        <h3>INCIDENT INFORMATION</h3>
        <table width="100%">
            <tr>
                <td><label>INCIDENT TYPE:</label></td>
                <td><input type="text" name="incitype" value="<?php echo $row['incitype']; ?>"></td>
                <td colspan="3"><label>DATE OF INCIDENT:</label></td>
                <td><input type="text" name="incidate" value="<?php echo $row['incidate']; ?>"></td>
            </tr>
            <tr>
                <td><label>LOCATION:</label></td>
                <td colspan="6"><input type="text" name="locate" value="<?php echo $row['locate']; ?>"></td>
            </tr>
            <tr>
                <td><label>CITY:</label></td>
                <td>
                    <select name="city" class="dropdown1">
                        <option <?php if ($row['city'] == 'CHENNAI') echo 'selected'; ?>>CHENNAI</option>
                        <option <?php if ($row['city'] == 'WAYANAD') echo 'selected'; ?>>WAYANAD</option>
                        <option <?php if ($row['city'] == 'COIMBATURE') echo 'selected'; ?>>COIMBATURE</option>
                        <option <?php if ($row['city'] == 'THIRUVANANDHAPURAM') echo 'selected'; ?>>THIRUVANANDHAPURAM</option>
                        <option <?php if ($row['city'] == 'MADURAI') echo 'selected'; ?>>MADURAI</option>
                    </select>
                </td>
                <td><label>STATE:</label></td>
                <td>
                    <select name="state" class="dropdown2">
                        <option <?php if ($row['state'] == 'TAMIL NADU') echo 'selected'; ?>>TAMIL NADU</option>
                        <option <?php if ($row['state'] == 'KERALA') echo 'selected'; ?>>KERALA</option>
                    </select>
                </td>
                <td><label>ZIP CODE:</label></td>
                <td><input type="text" name="zip" value="<?php echo $row['zip']; ?>"></td>
            </tr>
        </table>
        <div>
            <label>INCIDENT DESCRIPTION</label>
            <br>
            <textarea name="incides"><?php echo $row['incides']; ?></textarea>
            <br>
            <label>FOLLOW UP ACTION</label>
            <br>
            <textarea name="act"><?php echo $row['act']; ?></textarea>
        </div>
        <button name="update" id="btn">UPDATE</button>
    </form>
</body>
</html>
