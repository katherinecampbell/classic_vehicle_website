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
echo "<tr><th>Product Line</th><th>Description</th></tr>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "classicmodels";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("So sorry! Connection failed! Try again: " . $conn->connect_error);
}
    
$sql = "SELECT productLine,textDescription FROM productlines".";";
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["productLine"] ."</td><td>".$row["textDescription"] ."</td>";
        echo "</tr>";
    }

$conn->close();
echo '</table>';
echo '</div>';
?>
    

<?php include("footer.php") ?>

    
    
</body>
</html>