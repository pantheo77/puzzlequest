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
     <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    
    <title>Roster</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <?php 
        if ($result = mysqli_query($con,"SELECT id FROM roster")){
            $row_cnt = mysqli_num_rows($result);
            mysqli_free_result($result);
        }
        
        $sql = "SELECT * FROM roster ORDER BY Level desc, Name asc";
        $run = mysqli_query($con,$sql);
        $i=1;
        $line = 0;
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
            $line = $i % 4;
            
            if($line == 1){        
    
    ?>
    <div class="row mb-2">
    <?php } ?>
        <div class="col-sm-3 align-items-stretch">
            <div class="card bg-light">
                <div class="card-body">
                    
                    <h6 class="card-subtitle mb-2 text-muted text-right"><?php echo str_repeat("&#9733;", strlen($Rating)); ?></h6>
                    <h6 class="card-subtitle mb-2 text-muted text-right text-uppercase"><?php echo $Character." Character"; ?></h6>
                    <h6 class="card-subtitle mb-2 text-muted text-left">Level <span class="font-weight-bold lead"><?php echo $Level; ?></span></h6>
                    <h4 class="card-title"><?php echo $Name; ?></h4>
                    <h6 class="card-subtitle mb-2 text-muted text-right">(<?php echo $Discrimination; ?>)</h6>
                    <?php 
                        if($Champion == 'Y'){
                            $maxed = '';
                            if($Character == "Common" and $Level == 90){
                                $maxed = ' Maxed';
                            } elseif($Character == "Uncommon" and $Level == 144){
                                $maxed = ' Maxed';
                            } elseif($Character == "Rare" and $Level == 266){
                                $maxed = ' Maxed';
                            }
                            echo "<h5 class='bg-light card-text text-center text-muted'>Champion" . $maxed ."</h5>";
                            
                        } else {
                            echo "<h5 class='bg-light card-text text-center text-muted'>Covers " . ($P1Lvl + $P2Lvl + $P3Lvl) ."/13</h5>";
                        }
                    ?>
                    <p class="card-text">Health: <?php echo $Health; ?>hp</p>
                    <hr>
                    <p class="card-text text-center">Damage</p>
                    <!-- Chart here -->
                    <canvas id="myChart<?php echo $id; ?>" width="200" height="200"></canvas>
                    <script>
                        var ctx = document.getElementById("myChart<?php echo $id; ?>");
                        var myChart = new Chart(ctx,{
                            type: 'bar',
                            data: {
                                labels: ['Yel','Red','Blu','Prp','Grn','Blk','Wht'],
                                datasets: [{
                                    backgroundColor: ["#ffec03", "#d90b0b","#036eff","#c600ce","#00de09","#818181","#dedede"],
                                    data: [<?php echo $dYellow; ?>,<?php echo $dRed; ?>,<?php echo $dBlue; ?>,<?php echo $dPurple; ?>,<?php echo $dGreen; ?>,<?php echo $dBlack; ?>,<?php echo $dWhite; ?>]                                
                                }]
                            },
                            options: {  legend: {display: false},
                                        scales:{
                                            yAxes:[{
                                                ticks:{
                                                    max: 500,
                                                    min:0
                                                }
                                            }]
                                        }
                                        
                                     }
                            })
                    </script>
                    <div class="row mb-2">
                        <div class="col text-center"><mark class="border bg-warning rounded font-weight-bold"><?php echo $dYellow; ?></mark></div>
                        <div class="col text-center"><mark class="border bg-danger rounded font-weight-bold"><?php echo $dRed; ?></mark></div>
                        <div class="col text-center"><mark class="border bg-primary rounded font-weight-bold"><?php echo $dBlue; ?></mark></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col text-center"><mark style="background-color: purple" class="border text-light rounded font-weight-bold"><?php echo $dPurple; ?></mark></div>
                        <div class="col text-center"><mark class="border bg-success rounded font-weight-bold"><?php echo $dGreen; ?></mark></div>
                        <div class="col text-center"><mark class="border text-light bg-dark rounded font-weight-bold"><?php echo $dBlack; ?></mark></div>
                    </div>  
                     <div class="row mb-2">
                        <div class="col text-center"><mark class="bg-light border rounded font-weight-bold"><?php echo $dCritical ."x"; ?></mark></div>
                         <div class="col text-center"><span class="border rounded font-weight-bold"><?php echo $dWhite; ?></span></div>
                    </div>
                    <hr>
                    <p class="card-text text-center"><strong>Powers</strong></p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php 
                            if($P1Lvl == 0){
                                $P1Lvl = "-";
                            }
                            echo "<strong>" . $P1Lvl . "</strong> " . $Power1; 
                        ?>
                        </li>
                        <li class="list-group-item"><?php 
                            if($P2Lvl == 0){
                                $P2Lvl = "-";
                            }
                            echo "<strong>" . $P2Lvl . "</strong> " . $Power2; 
                        ?>
                        </li>
                        <li class="list-group-item"><?php 
                            if($P3Lvl == 0){
                                $P3Lvl = "-";
                            }
                            echo "<strong>" . $P3Lvl . "</strong> " . $Power3; 
                        ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php 
            if($line == 0 or $i == $row_cnt){
                ?>
    </div>
    <?php } ?>
    
    <?php 
        $i++;
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