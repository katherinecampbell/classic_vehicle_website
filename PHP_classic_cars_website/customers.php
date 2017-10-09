
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="project_classic_models.css">
</head>
<body>
<?php include('navbar.php')?>
   
<?php
    
echo '<div class="table">';
echo "<table class='productline'>";
echo "<tr><th>Customer Country</th><th>Name</th><th>City</th><th>Phone Number</th></tr>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "classicmodels";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
$sql = "SELECT country,customerName,city,phone FROM customers ORDER BY country".";";
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["country"] ."</td><td>".$row["customerName"] ."</td><td>".$row["city"]."</td><td>".$row["phone"]."</td>";
        echo "</tr>";
    }

$conn->close();
echo '</table>';
echo '</div>';
?>    
    
    

<div class="pfooter">
<?php include("footer.php") ?>
</div>
</body>
</html>