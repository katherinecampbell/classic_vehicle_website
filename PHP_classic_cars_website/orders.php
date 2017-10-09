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
 //catch and try PDO connection and table from w3 schools http://www.w3schools.com/php/php_mysql_select.asp//   
 try {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
     //Query inspiration from stack overflow: http://stackoverflow.com/questions/12125904/select-last-n-rows-from-mysql//
    $queryrecent = "SELECT orderNumber,orderDate,status FROM orders ORDER BY 'orderDate' DESC LIMIT 20";
    $datarecent = $conn -> query($queryrecent);
    $datarecent-> setFetchMode(PDO::FETCH_ASSOC);      
            echo "<div class='tbl2'>";
            echo "<table class='recenttbl'>";
            echo "<caption>20 Most Recent Orders</caption>";
            echo "<tr><th>Order #</th><th>Order Date</th><th>Status</th></tr>"; 
     //Below code about putting link in table is from stackoverflow users CalvT Uzair Bin Nisar at http://stackoverflow.com/questions/3337914/how-to-make-a-td-a-link// 
     
     foreach($datarecent->fetchAll()as $row) {
            $orderdetail=$row['orderNumber'];
            echo "<tr><td><a href='orders.php?orderdetail=".$orderdetail."'method = 'GET'>"
            .$row["orderNumber"] ."</a></td><td>".$row["orderDate"] ."</td><td>".$row["status"] ."</td>";
            echo "</tr>";
      }
        echo '</table>';
    echo '</div>';
     
     
     
     
    $queryprocess = "SELECT orderNumber,orderDate,status FROM orders WHERE status='In Process'";
    $dataprocess = $conn -> query($queryprocess);
    $dataprocess-> setFetchMode(PDO::FETCH_ASSOC);      
            echo "<div class='tbl'>";
            echo "<table class='processtbl'>";
            echo "<caption>Orders in Process</caption>";
            echo "<tr><th>Order #</th><th>Order Date</th><th>Status</th></tr>"; 
      foreach($dataprocess->fetchAll()as $row) {
          $orderdetail=$row['orderNumber'];
            echo "<tr><td><a href='orders.php?orderdetail=".$orderdetail."'method = 'GET'>"
            .$row["orderNumber"] ."</a></td><td>".$row["orderDate"] ."</td><td>".$row["status"] ."</td>";
            echo "</tr>";
      }
        echo '</table>';
    echo '</div>';
    
    $querycancelled = "SELECT orderNumber,orderDate,status FROM orders WHERE status='Cancelled'";
    $datacancelled = $conn -> query($querycancelled);
    $datacancelled-> setFetchMode(PDO::FETCH_ASSOC);      
            echo "<div class='tbl4'>";
            echo "<table class='cancelledtbl'>";
            echo "<caption>Cancelled Orders</caption>";
            echo "<tr><th>Order #</th><th>Order Date</th><th>Status</th></tr>"; 
      foreach($datacancelled->fetchAll()as $row) {
          $orderdetail=$row['orderNumber'];
            echo "<tr><td><a href='orders.php?orderdetail=".$orderdetail."'method = 'GET'>"
            .$row["orderNumber"] ."</a></td><td>".$row["orderDate"] ."</td><td>".$row["status"] ."</td>";
            echo "</tr>";
      }
        echo '</table>';
    echo '</div>';
 
//understanding of get from W3 schools
$orderdetail=$row['orderNumber'];    
if(isset($_GET['orderdetail'])) {
    $orderdetail= htmlspecialchars($_GET['orderdetail']);  
    //inspiration for this query from stack over-flow user bluefeet at http://stackoverflow.com/questions/10195451/sql-inner-join-with-3-tables
     $querydetailed = "SELECT o.orderNumber, o.orderDate, o.requiredDate, p.productCode, p.productLine, p.productName, o.status, o.comments, o.customerNumber 
     FROM orders as o 
     INNER JOIN orderdetails as od ON o.orderNumber = od.orderNumber
     INNER JOIN products as p ON od.productCode = p.productCode
     WHERE o.orderNumber=".$orderdetail.";";
    
    $datadetailed = $conn -> query($querydetailed);
    $datadetailed-> setFetchMode(PDO::FETCH_ASSOC);      
    
            echo "<div class='tbl3'>";
            echo "<table class='detailtbl'>";
            echo "<caption>Order Details</caption>";
            echo "<tr><th>Order #</th><th>Order Date</th><th>Product Name</th><th>Product Code</th><th>Product Line</th><th>Status</th><th>Comments</th><th>Customer #</th></tr>"; 
   
    //understanding fetchALL help from stackoverflow at http://stackoverflow.com/questions/17729301/php-pdo-fetchall-while-not-working-foreach-works and W3 schools PDO connections as previously stated
     
     foreach($datadetailed->fetchAll()as $row) {
            $orderdetail=$row['orderNumber'];
            echo "<tr><td>".$row["orderNumber"] ."</a></td><td>".$row["orderDate"] ."</td><td>".$row["productName"] ."</td><td>".$row["productCode"] ."</td><td>".$row["productLine"] ."</td><td>".$row["status"] ."</td><td>".$row["comments"] ."</td><td>".$row["customerNumber"] ."</td>";
            echo "</tr>";
      }
        echo '</table>';
    echo '</div>';
     
     
 }
 }
    
    
catch(PDOException $pe) {
    die("So sorry! Connection failed to database $dbname:" . $pe->getMessage());
}
    $conn = null;
    

    ?>
    
<div class="pfooter">
<?php include("footer.php") ?>
</div>

</body>
</html>
