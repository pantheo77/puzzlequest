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
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/style.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    
    <style>
        .dataTables_wrapper {
            font-size: 12px;
            position: relative;
            clear: both;
            *zoom: 1;
            zoom: 1;
        }
    </style>
    
    <title>Supports Dasboard</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container-fluid" align="center">
    <table class="table table-bordered table-hover table-sm display" id="dashboard">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Level</th>
                <th>Rating</th>
                <th>Equip To</th>
                <th>Equipped At</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT supports.id, supports.Name, supports.Description, supports.`Level`, supports.Stars, supports.EquipTo, CONCAT(roster.Name, ' - ', roster.Discrimination, ' (', roster.`Character`, ')')  AS heroname FROM supports LEFT JOIN roster ON supports.id = roster.equippedsupport ORDER BY `level` desc, Stars desc,  Name asc;";
                
                $run = mysqli_query($con,$sql);
                $i=1;
                $champ = 0;
                while($row = mysqli_fetch_array($run)){
                    $id = $row['id'];
                    $Name = $row['Name'];
                    $Description = $row['Description'];
                    $Level = $row['Level'];
                    $Stars = $row['Stars'];
                    $EquipTo = $row['EquipTo'];
                    $EquippedAt = $row['heroname'];
            ?>
            <tr>
                <td class="text-right"><?php echo $i; ?></td> 
                <td><a href="editSupport.php?id=<?php echo $id; ?>"><?php echo $Name; ?></a></td> 
                <td><?php echo $Description; ?></td> 
                <td class="text-right"><?php echo $Level . '/' . strlen($Stars)*50; ?></td> 
                <td class="text-center"><strong><?php echo str_repeat("&#9733", strlen($Stars)); ?></strong></td> 
                <td><?php echo $EquipTo; ?></td> 
                <td><?php echo $EquippedAt; ?></td> 
                <td class="text-center"><a href="supports.php?did=<?php echo $id;?>">Delete</a></td> 
            </tr>
            
            <?php 
                $i++;    
                }
            ?>
        </tbody>
    </table>
        
    <?php 
    if(isset($_GET['did'])){
        $did = $_GET['did'];
        $delete = "DELETE FROM supports WHERE ID = " . $did;
        $run_delete = mysqli_query($con,$delete);
    
        if($run_delete){
                echo "<script>window.open('heroCRUD.php','_self')</script>";
            }
    }
    ?>
    </div>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    
    <script>$(document).ready(function() {
        $('#dashboard').DataTable( {
        "pageLength": 15,
        buttons: [{
            extend: 'csv',
            fieldSeparator: ';',
            title: 'data',
            text: "Export" 
        }],
            searching: true,
            ordering: true,
            select: true,
            dom: 'fBrtip<"clear">l',
            "columnDefs": [{
                className: "dt-right",
                "targets": [0] // First column
            }]
        } );
        // The data tables bootstrap css didn't include styling for the plugin buttons
        $('.dt-button').addClass('btn btn-default');
       
        } );
    </script>
    
    
    
</body>
</html>