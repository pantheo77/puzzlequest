<!DOCTYPE html>
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php 
    include 'pqconnect.php';
?>
<html>
<head>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <title>Edit Support</title>
    
</head>
<body>
    <?php include 'menu.php'; ?>
    <?php 
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM supports WHERE ID = " . $id .";";
    
                $run = mysqli_query($con,$sql);
                $i=1;
                $row = mysqli_fetch_array($run);
                    $id = $row['id'];
                    $Name = $row['Name'];
                    $Description = $row['Description'];
                    $Level = $row['Level'];
                    $Stars = $row['Stars'];
                    $EquipTo = $row['EquipTo'];
    
    ?>
    
    <div class="container">
        <h1 class="text-center">Edit Support</h1>
        <form action="editsupport.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $Name; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" id="description" value="<?php echo $Description; ?>">
            </div>
            <div class="form-inline">
                <label for="level">Level:</label>
                <input type="text" class="form-control" name="level" id="level" size="1" value="<?php echo $Level; ?>">
            
                <label for="stars">Rating:</label>
                <select class="form-control" name="stars">
                    <option value="*" <?php if($Stars == '*'){ echo 'selected'; } ?>>*</option>
                    <option value="**" <?php if($Stars == '**'){ echo 'selected'; } ?>>**</option>
                    <option value="***" <?php if($Stars == '***'){ echo 'selected'; } ?>>***</option>
                    <option value="****" <?php if($Stars == '****'){ echo 'selected'; } ?>>****</option>
                    <option value="*****" <?php if($Stars == '*****'){ echo 'selected'; } ?>>*****</option>
                </select>
            </div>
            <div class="form-group">
                <label for="EquipTo">Equip To:</label>
                <input type="text" class="form-control" name="EquipTo" id="EquipTo" size="1" value="<?php echo $EquipTo; ?>">
            </div>
            <div class="form-group">
                <div class="text-center">
                    <input type="submit" name="update" value="Edit Support" class="btn btn-dark">
                </div>
            </div>
            
            
        </form> 
    </div>
    
    <?php
        if(isset($_POST['update'])){
            
        $id = mysqli_real_escape_string($con,$_REQUEST['id']);
        $name = mysqli_real_escape_string($con,$_REQUEST['name']);
        $description = mysqli_real_escape_string($con,$_REQUEST['description']);
        $level = mysqli_real_escape_string($con,$_REQUEST['level']);
        $stars = mysqli_real_escape_string($con,$_REQUEST['stars']);
        $EquipTo = mysqli_real_escape_string($con,$_REQUEST['EquipTo']);
        

        $sqlupd = "UPDATE supports SET
            Name = '" . $name . "',
            Description = '" . $description . "',
            `Level` = " . $level . ",
            Stars = '" . $stars . "',
            EquipTo = '" . $EquipTo . "'
            WHERE ID = " . $id . ";";
            //echo $sqlupd;

        $runupd = mysqli_query($con,$sqlupd);
        
        if($runupd){
            echo "<script>window.open('supports.php','_self')</script>";
        }
    }

    ?>
    
    
    
    
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>