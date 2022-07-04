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
<?php include 'pqconnect.php'; ?>

<html lang="en">
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
    
    <title>Ratings</title>
</head>
<body>
    <div class="container-fluid" align="center">
    <table class="table table-bordered table-hover table-sm display" id="dashboard">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Discrimination</th>
                <th>Level</th>
                <th>Current</th>
                <th>Ideal</th>
                <th>Ranking</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'menu.php'; ?>
            <?php
            $i=1;
            $sql = "SELECT  roster.NAME, roster.Discrimination, CONCAT(LENGTH(roster.Rating),'*') AS Rating, CONCAT(roster.P1Lvl,'/',roster.P2Lvl,'/',roster.P3Lvl) as Situation, 
                    mpqratings.Development AS Ideal, mpqratings.Ranking, mpqratings.Comments, 'Y' as Owned, mpqratings.Place
                    FROM roster LEFT JOIN mpqratings ON roster.ID = mpqratings.RosterID 
                    UNION
                    SELECT mpqratings.Name, mpqratings.Stars, mpqratings.Stars AS Rating , '0/0/0' as Situation, mpqratings.Development AS Ideal, mpqratings.Ranking, mpqratings.Comments, 'N' as Owned,mpqratings.Place
                    FROM mpqratings
                    WHERE mpqratings.RosterID IS NULL 
                    ORDER BY Place";
                    /* OLD QUERY
                    SELECT  roster.NAME, roster.Discrimination, roster.Rating AS Rating, CONCAT(roster.P1Lvl,'/',roster.P2Lvl,'/',roster.P3Lvl) as Situation, 
                    mpqratings.Development AS Ideal, mpqratings.Ranking, mpqratings.Comments, 'Y' as Owned, mpqratings.Place
                    FROM roster LEFT JOIN mpqratings ON roster.ID = mpqratings.RosterID 
                    UNION
                    SELECT mpqratings.Name, mpqratings.Stars, repeat('*',LEFT(mpqratings.Stars,1)) AS Rating , '0/0/0' as Situation, mpqratings.Development AS Ideal, mpqratings.Ranking, mpqratings.Comments, 'N' as Owned,mpqratings.Place
                    FROM mpqratings
                    WHERE mpqratings.RosterID IS NULL 
                    ORDER BY Place  */      
            $run = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($run)){
                $Name = $row['NAME'];
                $Discrimination = $row['Discrimination'];
                $Rating = $row['Rating'];
                $Situation = $row['Situation'];
                $Ideal = $row['Ideal'];
                $Ranking = $row['Ranking'];
                $Comments = $row['Comments'];
                $Owned = $row['Owned'];
            ?>
            <tr>
                <td class="text-right"><?php echo $i; ?></td> 
                <td class="text-left">
                    <?php if(($Owned) == 'Y'){ echo "<strong>";} ?>
                    <?php echo $Name; ?>
                    <?php if(($Owned) == 'Y'){ echo "</strong>";} ?>
                </td> 
                <td class="text-left"><?php echo $Discrimination; ?></td> 
                <td class="text-left"><?php echo $Rating; ?></td> 
                <td class="text-left"><?php echo $Situation; ?></td> 
                <td class="text-left"><?php echo $Ideal; ?></td> 
                <td class="text-left"><?php echo $Ranking; ?></td> 
                <td class="text-left"><?php echo $Comments; ?></td> 
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
    </div>
    </body>
</html>