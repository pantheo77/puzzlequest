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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
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
    
    <title>Heroes Dashboard</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container-fluid" align="center">
    <table class="table table-bordered table-hover table-sm display" id="dashboard">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Discr</th>
                <th>Level</th>
                <th>Character</th>
                <th>Rating</th>
                <th>Health</th>
                <th class="text-warning">D.Yel</th>
                <th class="text-danger">D.Red</th>
                <th class="text-primary">D.Blu</th>
                <th style="color:rgb(238, 130, 238);">D.Prp</th>
                <th class="text-success">D.Grn</th>
                <th class="bg-light text-dark">D.Blk</th>
                <th>Crit</th>
                <th>D.Wht</th>
                <th>Covers</th>
                <!--<th>Power 1 - (Level)</th>
                <th>Power 2 - (Level)</th>
                <th>Power 3 - (Level)</th>-->
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * FROM roster ORDER BY Level desc, Name asc;";
                
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
                    <a href="editHero.php?id=<?php echo $id; ?>"><?php echo $Name; ?></a>
                    <?php if(($P1Lvl+$P2Lvl+$P3Lvl) == 13){ echo " &#10026;</strong>";} ?></td> 
                <td><?php echo $Discrimination; ?></td> 
                <td class="text-right"><?php echo $Level; ?></td> 
                <td><?php echo $Character; ?></td> 
                <td class="text-center"><strong><?php echo str_repeat("&#9733", strlen($Rating)); ?></strong></td> 
                <td class="text-right"><?php echo $Health; ?></td> 
                <td class="text-right"><?php echo $dYellow; ?></td> 
                <td class="text-right"><?php echo $dRed; ?></td> 
                <td class="text-right"><?php echo $dBlue; ?></td> 
                <td class="text-right"><?php echo $dPurple; ?></td> 
                <td class="text-right"><?php echo $dGreen; ?></td> 
                <td class="text-right"><?php echo $dBlack; ?></td> 
                <td class="text-right"><?php echo $dCritical ."x"; ?></td> 
                <td class="text-right"><?php echo $dWhite; ?></td> 
                <td class="text-right"><?php if(($P1Lvl+$P2Lvl+$P3Lvl) == 13){ echo "<strong>" . ($P1Lvl+$P2Lvl+$P3Lvl) . "/13</strong>"; $champ++; } else { echo ($P1Lvl+$P2Lvl+$P3Lvl) ."/13"; }  ?></td> 
                <!--<td><?php echo $Power1 . " - "; ?><strong style="font-size:1.15em;">(<?php echo $P1Lvl; ?>)</strong></td> 
                <td><?php echo $Power2 . " - "; ?><strong style="font-size:1.15em;">(<?php echo $P2Lvl; ?>)</strong></td> 
                <td><?php echo $Power3 . " - "; ?><strong style="font-size:1.15em;">(<?php echo $P3Lvl; ?>)</strong></td>--> 
                <td class="text-center"><a href="heroCRUD.php?did=<?php echo $id;?>">Delete</a></td> 
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
        $delete = "DELETE FROM roster WHERE ID = " . $did;
        $run_delete = mysqli_query($con,$delete);
    
        if($run_delete){
                
                $update_ratings = "UPDATE mpqratings SET RosterID = null WHERE RosterID = " . $did ;
                $run_update_ratings = mysqli_query($con,$update_ratings);

                $update_TotalRoster = "UPDATE roster_total SET RosterID =  NULL WHERE RosterID = " .$did ;
                $run_update_TotalRoster = mysqli_query($con,$update_TotalRoster);

                echo "<script>window.open('heroCRUD.php','_self')</script>";
            }
    }
    ?>
    </div>
    <!--
    <div class="container">
        <div class="row row-cols-3">
                    <?php 
                        $ct = 0;
                        $isql = "SELECT `Character`, Rating, COUNT(id) as totcov FROM roster GROUP BY `Character`, Rating ORDER BY Rating DESC;";
                        $irun = mysqli_query($con,$isql);
                        $ilabels = '';
                        $idata = "";

                        while($irow = mysqli_fetch_array($irun)){
                            $char = $irow['Character'];
                            $rat = $irow['Rating'];
                            $totcov = $irow['totcov'];
                            $ct += $totcov;
                            $ilabels .= ',"' . $char . '"';
                            $idata .= "," . $totcov; 
                        } 

                        $tot_ct = 0;
                        $rsql = "SELECT COUNT(ID) tot FROM roster_total;";
                        $rrun = mysqli_query($con,$rsql);
                        while($rrow = mysqli_fetch_array($rrun)){
                            $tot_ct = $rrow['tot'];
                        } 
                    ?>
            <div class="col">
                <canvas id="doughnut-chart" width="200" height="200"></canvas>
                <script>
                    var ctx = document.getElementById("doughnut-chart");
                    var myChart = new Chart(ctx,
                              {
                                "type":"doughnut",
                                "data":{
                                    "labels":[<?php echo substr($ilabels,1); ?>],
                                    "datasets":[
                                        {
                                            "data":[<?php echo substr($idata,1); ?>],
                                            "backgroundColor":["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)","rgb(0, 255, 108)"]
                                        }
                                    ]
                                },
                                "options": {  legend: {display: false} }
                    });

            </script>
                
            </div>
            <div class="col">
                <canvas id="doughnut-champ" width="200" height="200"></canvas>
                <script>
                    var ctx = document.getElementById("doughnut-champ");
                    var myChart = new Chart(ctx,
                              {
                                "type":"doughnut",
                                "data":{
                                    "labels":["Champions","Developing"],
                                    "datasets":[
                                        {
                                            "data":[<?php echo $champ; ?>,<?php echo $ct - $champ; ?>],
                                            "backgroundColor":["rgb(255, 191, 38)","rgb(255, 128, 0)"]
                                        }
                                    ]
                                },
                                "options": {  legend: {display: false} }
                    });

                </script>
            </div>
            <div class="col">
                <canvas id="doughnut-owned" width="200" height="200"></canvas>
                <script>
                    var ctx = document.getElementById("doughnut-owned");
                    var myChart = new Chart(ctx,
                              {
                                "type":"doughnut",
                                "data":{
                                    "labels":["Owned","Not owned"],
                                    "datasets":[
                                        {
                                            "data":[<?php echo $ct; ?>,<?php echo $tot_ct - $ct; ?>],
                                            "backgroundColor":["rgb(255, 97, 255)","rgb(82, 80, 85)"]
                                        }
                                    ]
                                },
                                "options": {  legend: {display: false} }
                    });

                </script>
            </div>
        </div>
    </div>
    -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
    <!-- Popper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    
    <script>$(document).ready(function() {
        $('#dashboard').DataTable( {
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
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