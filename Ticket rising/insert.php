<?php
echo "<form action='' method='post'>";
echo "<input type='text' name='search_term' placeholder='Search by name, title or incident no'>";
echo "<input type='submit' name='search' value='Search'>";
echo "</form>";
include "connect.php";
if(isset($_POST['submit']))
{
    $Reported_By=$_POST['name'];
    $Date_Of_Report=$_POST['dor'];
    $Title=$_POST['title'];
    $Incident_No=$_POST['incino'];
    $Incident_Type=$_POST['incitype'];
    $Date_Of_Incident=$_POST['incidate'];
    $Location=$_POST['locate'];
    $City=$_POST['city'];
    $State=$_POST['state'];
    $Zip_Code=$_POST['zip'];
    $Incident_Des=$_POST['incides'];
    $Follow_Up_Act=$_POST['act'];
    
    $sql="INSERT INTO incident(name,dor,title,incino,incitype,incidate,locate,city,state,zip,incides,act) VALUES('$Reported_By','$Date_Of_Report','$Title','$Incident_No','$Incident_Type','$Date_Of_Incident','$Location','$City','$State','$Zip_Code','$Incident_Des','$Follow_Up_Act')";
    $result=$conn->query($sql);
    if($result==TRUE)
    {
        echo "New Record Created";
    }
    else
    {
        echo "Error ".$sql."<br>".$conn->error;
    }
}
if(isset($_POST['search']))
{
    $search_term = $_POST['search_term'];
    $sql = "SELECT * FROM incident WHERE name LIKE '%$search_term%' OR title LIKE '%$search_term%' OR incino LIKE '%$search_term%'";
    $result = $conn->query($sql);
}
else
{
    $sql = "SELECT * FROM incident";
    $result = $conn->query($sql);
}
if ($result->num_rows > 0) {
    echo "<table border='1' id='tab'>";
    echo "<tr><th>Report_By</th><th>Date_of_Report</th><th>Title/Role</th><th>Incident_No</th><th>Incident_type</th><th>Date_of_Incident</th><th>Location</th><th>City</th><th>State</th><th>Zip_Code</th><th>Incident_Description</th><th>Follow_up Action</th><th>Edit</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["dor"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["incino"] . "</td>";
        echo "<td>" . $row["incitype"] . "</td>";
        echo "<td>" . $row["incidate"] . "</td>";
        echo "<td>" . $row["locate"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["state"] . "</td>";
        echo "<td>" . $row["zip"] . "</td>";
        echo "<td>" . $row["incides"] . "</td>";
        echo "<td>" . $row["act"] . "</td>";
        echo "<td><a name='update_btn' href='update.php?id=" . $row['incino'] . "'>EDIT</a></td>";
        echo "<td><a name='delete_btn' href='delete.php?id=" . $row['incino'] . "'>DELETE</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br><a href='form.html'>Add More</a>"; 
} else {
    echo "No records found";
}
$conn->close();
