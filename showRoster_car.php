<!DOCTYPE html>
<?php include 'pqconnect.php'; ?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    
    <title>Roster</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php 
                $sqlcnt = "SELECT COUNT(ID) FROM roster limit 1";
                $runcnt = mysqli_query($con,$sqlcnt);
                $maxid = mysqli_fetch_array($runcnt);
                
                for($j = 0 ; $j < $maxid['COUNT(ID)']; $j++){
                    
            ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>"<?php if($j == 0){ echo ' class="active"';}?>></li>
            <?php } ?>
        </ol>
        <div class="carousel-inner">
        <?php 
        if ($result = mysqli_query($con,"SELECT id FROM roster")){
            $row_cnt = mysqli_num_rows($result);
            mysqli_free_result($result);
        }
        
        $sql = "SELECT * FROM roster ORDER BY Level desc, Name asc";
        $run = mysqli_query($con,$sql);
        $i=0;
        $line = 0;
        while($row = mysqli_fetch_array($run)){
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
            
           
    
    ?>
            <div class="item<?php if($i == 0){ echo " active";} ?>">
        <div class="col-sm-3 align-items-stretch">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted text-right"><?php echo str_repeat("&#9733", strlen($Rating)); ?></h6>
                    <h6 class="card-subtitle mb-2 text-muted text-right"><?php echo $Character." Character"; ?></h6>
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
                            
                        }
                    ?>
                    <p class="card-text">Health: <?php echo $Health; ?>hp</p>
                    <hr>
                    <p class="card-text text-center">Damage</p>
                    <div class="row mb-2">
                        <div class="col text-center"><mark class="border bg-warning rounded"><?php echo $dYellow; ?></mark></div>
                        <div class="col text-center"><mark class="border bg-danger rounded"><?php echo $dRed; ?></mark></div>
                        <div class="col text-center"><mark class="border bg-primary rounded"><?php echo $dBlue; ?></mark></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col text-center"><mark style="background-color: purple" class="border text-light rounded"><?php echo $dPurple; ?></mark></div>
                        <div class="col text-center"><mark class="border bg-success rounded"><?php echo $dGreen; ?></mark></div>
                        <div class="col text-center"><mark class="border text-light bg-dark rounded"><?php echo $dBlack; ?></mark></div>
                    </div>  
                     <div class="row mb-2">
                        <div class="col text-center"><mark class="bg-light border rounded"><?php echo $dCritical ."x"; ?></mark></div>
                         <div class="col text-center"><span class="border rounded"><?php echo $dWhite; ?></span></div>
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
            </div>
    
    <?php 
        $i++;
        } 
    ?>
    </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>