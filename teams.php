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
    
    <title>Teams</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container-fluid" align="center">
    <table class="table table-bordered table-hover table-sm display" id="dashboard">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Team Level</th>
<!--                <th>ID 1</th>-->
                <th>Member 1</th>
<!--                <th>ID 2</th>-->
                <th>Member 2</th>
<!--                <th>ID 3</th>-->
                <th>Member 3</th>
                <th>Modus Operandi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * FROM teams ORDER BY FIELD(TeamLevel, '5*', '4* and 5*', '4*', '3* and 4*', '3*', '2*');";
                
                $run = mysqli_query($con,$sql);
                $i=1;
                $champ = 0;
                while($row = mysqli_fetch_array($run)){
                    $id = $row['id'];
                    $TeamLevel = $row['TeamLevel'];
                    $ID1 = $row['ID1'];
                    $Member1 = $row['Member1']; 
                    $ID2 = $row['ID2'];
                    $Member2 = $row['Member2']; 
                    $ID3 = $row['ID3'];
                    $Member3 = $row['Member3'];
                    $ModusOperandi = $row['ModusOperandi'];
            ?>
            <tr>
                <td><?php echo $i; ?></td> 
                <td><?php echo $TeamLevel; ?></td> 
<!--                <td><?php echo $ID1; ?></td> -->
                <td><?php echo $Member1; ?></td> 
<!--                <td><?php echo $ID2; ?></td> -->
                <td><?php echo $Member2; ?></td> 
<!--                <td><?php echo $ID3; ?></td> -->
                <td><?php echo $Member3; ?></td> 
                <td><?php echo $ModusOperandi; ?></td> 
            </tr>
            <?php  
                $i++;
                }
            ?>
        </tbody>
    </table>          
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
    </div>
    </body>
</html>