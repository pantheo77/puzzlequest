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
    
    <title>Unowned Heroes</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container-fluid" align="center">
    <table class="table table-bordered table-hover table-sm display" id="dashboard">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Discr</th>
                <th>Power 1</th>
                <th>Power 2</th>
                <th>Power 3</th>
                <th>Insert</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * FROM roster_total WHERE RosterID IS NULL ORDER BY Rating desc, Name asc;";
                
                $run = mysqli_query($con,$sql);
                $i=1;
                $champ = 0;
                while($row = mysqli_fetch_array($run)){
                    $id = $row['ID'];
                    $Name = $row['Name'];
                    $Discrimination = $row['Discrimination'];
                    $Level = $row['Level'];
                    $Character = $row['Character'];
                    $Rating = $row['Rating'];
                    $Health = $row['Health'];
                    $dYellow = $row['dYellow'];
                    $dRed = $row['dRed'];
                    $dBlue = $row['dBlue'];
                    $dPurple = $row['dPurple'];
                    $dGreen = $row['dGreen'];
                    $dBlack = $row['dBlack'];
                    $dCritical = $row['dCritical'];
                    $dWhite = $row['dWhite'];
                    $Champion = $row['Champion'];
                    $Power1 = $row['Power1'];
                    $P1Lvl = $row['P1Lvl'];
                    $Power2 = $row['Power2'];
                    $P2Lvl = $row['P2Lvl'];
                    $Power3 = $row['Power3'];
                    $P3Lvl = $row['P3Lvl'];
            ?>
            <tr>
                <td class="text-right"><?php echo $i; ?></td> 
                <td><?php if(($P1Lvl+$P2Lvl+$P3Lvl) == 13){ echo "<strong>";} ?>
                    <?php echo $Name; ?>
                    <?php if(($P1Lvl+$P2Lvl+$P3Lvl) == 13){ echo " &#10026;</strong>";} ?></td> 
                <td><?php echo $Discrimination; ?></td> 
                <td><?php echo $Power1; ?></td> 
                <td><?php echo $Power2; ?></td> 
                <td><?php echo $Power3; ?></td> 
                <td class="text-center"><a href="insertFromTable.php?did=<?php echo $id;?>">Insert</a></td> 
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
        $insert = "INSERT INTO roster(Name,Discrimination,Power1,Power2,Power3,equippedsupport,`Level`,`Character`,Rating,Health,dYellow,dRed,dBlue,dPurple,dGreen,dBlack,dCritical,dWhite) 
        SELECT Name,Discrimination,Power1,Power2,Power3,0,`Level`,`Character`,Rating,Health,dYellow,dRed,dBlue,dPurple,dGreen,dBlack,dCritical,dWhite FROM roster_total
        WHERE ID = " . $did;
        $run_insert = mysqli_query($con,$insert);
    
        if($run_insert){
                echo '<div class="alert alert-success" id="success-alert"><strong>Success!</strong> Record created.</div>';
                $last_id = mysqli_insert_id($con);
                $updatesql = "UPDATE roster_total SET RosterID = " . $last_id . " WHERE ID = " . $did;
                $run_update = mysqli_query($con,$updatesql);
                $ratingssql = "UPDATE mpqratings SET RosterID = (SELECT roster_total.RosterID FROM roster_total WHERE roster_total.ID = mpqratings.TotalRosterID)";
                $run_ratingssql = mysqli_query($con,$ratingssql);
                echo '<script>window.location.replace("http://localhost/puzzlequest/heroCRUD.php");</script>';
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
        "pageLength": 20,
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