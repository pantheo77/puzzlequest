<?php
require_once('pqPDOconnect.php');

$isFullList = true;

//This can be split into two separate pages.
if(isset($_GET['rid']) && ctype_digit($_GET['rid'])){
  //details
  $isFullList = false;
  $pid = intval($_GET['rid']);
  $strSQL = "SELECT * FROM roster WHERE id=?";
  $prepared = $conn->prepare($strSQL);
  $prepared->execute(array($pid));
  // product_id, product_name, category_name, product_price, product_unit
}else{
  //full list
  $strSQL = "SELECT * FROM roster";
  $prepared = $conn->prepare($strSQL);
  $prepared->execute(array());
}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Master Detail</title>
  <link rel="stylesheet" href="./css/main.css">
</head>
<body>
  <?php 
    //require_once('header.inc.php'); 
  ?>
  <main>
    <?php
    if($isFullList){
      echo '<h2>List of Products</h2>';
      //list of product names with links
      if($prepared->rowCount() > 0){
        $prepared->setFetchMode(PDO::FETCH_ASSOC);
        while($row= $prepared->fetch()){
          echo '<p class="line">' . $row['Name'];
          echo '<a class="btn" href="master-detail.php?rid=' . $row['ID'] . '">';
          echo 'View Details</a></p>';
        }
      }else{
        //no products
        echo '<p>No products currently available.</p>';
      }
    }else{
      echo '<h2>Product Details</h2>';
      //all the properties of the one product
      if($prepared->rowCount() == 1){
        //we have a match
        $row = $prepared->fetch();
        echo '<p>' . $row['Name'] . ' ' . $row['Discrimination'] . '</p>';
        echo '<p>' . $row['Level'] .  '</p>';
        echo '<p>' . $row['Health'] . '</p>';
        
      }else{
        //no match
        echo '<p>No product match available.</p>';
      }
      echo '<p><a href="master-detail.php">&lt;&lt; Back to full product list</a></p>';
    }
    ?>
  </main>
</body>
</html>