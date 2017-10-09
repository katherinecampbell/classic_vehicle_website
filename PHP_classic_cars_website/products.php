<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="project_classic_models.css">
</head>
<body>
    
<?php include('navbar.php')?>
    
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "classicmodels"; 

echo '<div class="form">';
    //code below to make a form with 'get' courtasy of caveofprogramming.com at https://www.caveofprogramming.com/php-tutorial/php-get-and-post-getting-url-parameters-and-form-data-in-php.html
    
    echo '<form action="products.php" method="get">';
        echo '<p>Select a product line to view those items:</p>';
        
        // Create connection
    try {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // Code below how to populate a drop-down box from a mysql table courtasy of user Harmlezz and sush at stackoverflow.com at http://stackoverflow.com/questions/5189662/populate-a-drop-down-box-from-a-mysql-table-in-php. Group-by addition to the query is my own.
    
        $query = "SELECT productLine FROM products GROUP BY productLine";
        $data = $conn -> query ($query);
    
            echo "<select name='productline'>";
            echo "<option></option>";
            while($row = $data->fetch()) {
                echo "<option value='".$row['productLine']."'>".$row['productLine']."</option>";
            }
            echo "</select>";
        //}
        echo '<br>';
        echo '<br>';
        echo '<input type="submit" class="btnsubmit">';
    echo '</form>';
echo '</div>';    
    
// Show all URL parameters (and all form data submitted via the 'get' method)
// code below inspired by w3 schools at http://www.w3schools.com/php/php_mysql_select.asp
echo '<div class="table">';
echo "<table class='productline'>";
foreach($_GET as $key=>$value){
    if (isset($_GET['productline'])){
    $query2="SELECT productLine, productCode, productName, productVendor, productDescription, buyPrice FROM products WHERE productLine = '".$_GET['productline']."';";
        
    $data2 = $conn->prepare($query2);
    $data2->execute();}
    
       //clarification on PDO fetch command from http://php.net/manual/en/pdostatement.fetch.php
    
        while($row = $data2->fetch()) {
                //echo '<div class="table">';
                //echo "<table class='productline'>";
                echo "<tr><th>Product Name</th><th>Product Code</th><th>Product Vendor</th><th>Product Description</th><th>Price</th></tr>";
                echo "<tr><td>".$row['productName']."</td><td>".$row['productCode']."</td><td>".$row['productVendor']."</td><td>".$row['productDescription']."</td><td>".$row['buyPrice']."</td>";
                echo "</tr>";
}
}
         echo '</table>';
    echo '</div>';
    }
catch(PDOException $pe) {
    die("So sorry but cannot connect to database $dbname:" . $pe->getMessage());
}
    $conn = null;
    ?>
    
    
    
    
<?php include("footer.php") ?>
</body>
</html>