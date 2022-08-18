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
    
    <title>Edit Hero</title>
    
</head>
<body>
    <?php include 'menu.php'; ?>
    <?php 
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM roster WHERE ID = " . $id .";";
                $run = mysqli_query($con,$sql);
                $i=1;
                $row = mysqli_fetch_array($run);
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
                    $equippedsupport = $row['equippedsupport'];
                    $lastupdate = $row['LastUpdate'];
    
    ?>
    
    <div class="container">
        <h1 class="text-center">Edit Hero</h1>
        <form action="editHero.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $Name; ?>">
            </div>
            <div class="form-group">
                <label for="discrimination">Discrimination:</label>
                <input type="text" class="form-control" name="discrimination" id="discrimination" value="<?php echo $Discrimination; ?>">
            </div>
            <div class="form-inline">
                <label for="level">Level:</label>
                <input type="text" class="form-control" name="level" id="level" size="1" value="<?php echo $Level; ?>">
            </div>
            <div class="radio">
                <label><input type="radio" name="character" value="Common" 
                              <?php if($Character == 'Common'){ echo 'checked'; } ?>> Common Character ( * )</label><br>
                <label><input type="radio" name="character" value="Uncommon" <?php if($Character == 'Uncommon'){ echo 'checked'; } ?>> Uncommon Character ( ** )</label><br>
                <label><input type="radio" name="character" value="Rare" <?php if($Character == 'Rare'){ echo 'checked'; } ?>> Rare Character ( *** )</label><br>
                <label><input type="radio" name="character" value="Legendary" <?php if($Character == 'Legendary'){ echo 'checked'; } ?>> Legendary Character ( **** )</label><br>
                <label><input type="radio" name="character" value="Epic" <?php if($Character == 'Epic'){ echo 'checked'; } ?>> Epic Character ( ***** )</label><br>
            </div>
            <div class="form-inline">
                <label for="health">Health:</label>
                <input type="text" class="form-control" name="health" id="health" size="4" value="<?php echo $Health; ?>">
            </div>
            Damage<br>
            <div class="form-inline" style="margin-bottom:5px">
                <label for="dYellow" class="text-warning">Yellow:</label>
                <input type="text" class="form-control" name="dYellow" id="dYellow" size="1" value="<?php echo $dYellow; ?>">
                <label for="dRed" class="text-danger">Red:</label>
                <input type="text" class="form-control" name="dRed" id="dRed" size="1" value="<?php echo $dRed; ?>">
                <label for="dBlue" class="text-primary">Blue:</label>
                <input type="text" class="form-control" name="dBlue" id="dBlue" size="1" value="<?php echo $dBlue; ?>">
                <label for="dBlue" style="color:rgb(238, 130, 238);">Purple:</label>
                <input type="text" class="form-control" name="dPurple" id="dPurple" size="1" value="<?php echo $dPurple; ?>">
            </div>
            <div class="form-inline"  style="margin-bottom:5px">
                <label for="dBlue" class="text-success">Green:</label>
                <input type="text" class="form-control" name="dGreen" id="dGreen" size="1" value="<?php echo $dGreen; ?>">
                <label for="dBlack">Black:</label>
                <input type="text" class="form-control" name="dBlack" id="dBlack" size="1" value="<?php echo $dBlack; ?>">
                <label for="dCritical">Critical:</label>
                <input type="text" class="form-control" name="dCritical" id="dCritical" size="1"  value="<?php echo $dCritical; ?>">
                <label for="dBlack" class="text-light bg-dark">White:</label>
                <input type="text" class="form-control" name="dWhite" id="dWhite" size="1"  value="<?php echo $dWhite; ?>">
            </div>
            <div class="form-inline"  style="margin-bottom:5px">
                <label for="power1">Power 1:</label>
                <input type="text" class="form-control" name="power1" id="power1" value="<?php echo $Power1; ?>">
                <label for="p1lvl">Level:</label>
                <select class="form-control" name="p1lvl">
                    <option value="0" <?php if($P1Lvl == '0'){ echo 'selected'; } ?>>0</option>
                    <option value="1" <?php if($P1Lvl == '1'){ echo 'selected'; } ?>>1</option>
                    <option value="2" <?php if($P1Lvl == '2'){ echo 'selected'; } ?>>2</option>
                    <option value="3" <?php if($P1Lvl == '3'){ echo 'selected'; } ?>>3</option>
                    <option value="4" <?php if($P1Lvl == '4'){ echo 'selected'; } ?>>4</option>
                    <option value="5" <?php if($P1Lvl == '5'){ echo 'selected'; } ?>>5</option>
                </select>
            </div>
            <div class="form-inline"  style="margin-bottom:5px">
                <label for="power2">Power 2:</label>
                <input type="text" class="form-control" name="power2" id="power2" value="<?php echo $Power2; ?>">
                <label for="p2lvl">Level:</label>
                <select class="form-control" name="p2lvl">
                    <option value="0" <?php if($P2Lvl == '0'){ echo 'selected'; } ?>>0</option>
                    <option value="1" <?php if($P2Lvl == '1'){ echo 'selected'; } ?>>1</option>
                    <option value="2" <?php if($P2Lvl == '2'){ echo 'selected'; } ?>>2</option>
                    <option value="3" <?php if($P2Lvl == '3'){ echo 'selected'; } ?>>3</option>
                    <option value="4" <?php if($P2Lvl == '4'){ echo 'selected'; } ?>>4</option>
                    <option value="5" <?php if($P2Lvl == '5'){ echo 'selected'; } ?>>5</option>
                </select>
            </div>
            <div class="form-inline" style="margin-bottom:5px">
                <label for="power3">Power 3:</label>
                <input type="text" class="form-control" name="power3" id="power3" value="<?php echo $Power3; ?>">
                <label for="p3lvl">Level:</label>
                <select class="form-control" name="p3lvl">
                    <option value="0" <?php if($P3Lvl == '0'){ echo 'selected'; } ?>>0</option>
                    <option value="1" <?php if($P3Lvl == '1'){ echo 'selected'; } ?>>1</option>
                    <option value="2" <?php if($P3Lvl == '2'){ echo 'selected'; } ?>>2</option>
                    <option value="3" <?php if($P3Lvl == '3'){ echo 'selected'; } ?>>3</option>
                    <option value="4" <?php if($P3Lvl == '4'){ echo 'selected'; } ?>>4</option>
                    <option value="5" <?php if($P3Lvl == '5'){ echo 'selected'; } ?>>5</option>
                </select>
            </div>
			<div>
				<?php 
				$sqlopt = "SELECT * FROM mpqratings WHERE RosterID = " . $id . ";";
				$runopt = mysqli_query($con,$sqlopt);
				$rowopt = mysqli_fetch_array($runopt);
				$Development = $rowopt['Development'];
				$Ranking = $rowopt['Ranking'];
				?>
				<i class ="text-secondary">Optimal Development: <?php echo $Development; ?></i>
			</div>
            <div class="form-inline" style="margin-bottom:5px">
                <label for="equippedsupport" <?php if($Character == 'Common' OR $Character == 'Uncommon'){echo 'hidden';} ?>>Equipped Support:</label>
                <select class="form-control" name="equippedsupport" <?php if($Character == 'Common' OR $Character == 'Uncommon'){echo 'hidden';} ?>>
                    <?php 
                    $sqlsup = "SELECT id, Name FROM supports UNION ALL SELECT 0,'None Equipped';";
                    $runsup = mysqli_query($con,$sqlsup);
                    while($rowsup = mysqli_fetch_array($runsup)){
                        $sid = $rowsup['id'];
                        $supname = $rowsup['Name'];
                    ?>
                    <option value="<?php echo $sid; ?>" <?php if ($sid == $equippedsupport){ echo 'selected'; } ?>><?php echo $supname; ?></option>
                    <?php }; ?>
                </select>
            </div>
            <div class="form-group">
                <div class="text-center">
                    <input type="submit" name="update" value="Edit Hero" class="btn btn-dark">
                </div>
            </div>
            <div>
                <h5>(Last Updated on: <?php echo date("d M Y, H:i:s",strtotime($lastupdate)); ?>)</h5>
            </div>
        </form> 
    </div>
    
    <?php
        if(isset($_POST['update'])){
            
        $id = mysqli_real_escape_string($con,$_REQUEST['id']);
        $name = mysqli_real_escape_string($con,$_REQUEST['name']);
        $discrimination = mysqli_real_escape_string($con,$_REQUEST['discrimination']);
        $level = mysqli_real_escape_string($con,$_REQUEST['level']);
        $character = mysqli_real_escape_string($con,$_REQUEST['character']);
    
        $Rating = '';
        if($character == "Common"){
            $Rating = '*';
        } elseif($character == "Uncommon"){
            $Rating = '**';
        } elseif($character == "Rare"){
            $Rating = '***';
        } elseif($character == "Legendary"){
            $Rating = '****';
        } elseif($character == "Epic"){
            $Rating = '*****';
        } 
        
        $health = mysqli_real_escape_string($con,$_REQUEST['health']);
        $dYellow = mysqli_real_escape_string($con,$_REQUEST['dYellow']);
        $dRed = mysqli_real_escape_string($con,$_REQUEST['dRed']);
        $dBlue = mysqli_real_escape_string($con,$_REQUEST['dBlue']);
        $dPurple = mysqli_real_escape_string($con,$_REQUEST['dPurple']);
        $dGreen = mysqli_real_escape_string($con,$_REQUEST['dGreen']);
        $dBlack = mysqli_real_escape_string($con,$_REQUEST['dBlack']);
        $dCritical = mysqli_real_escape_string($con,$_REQUEST['dCritical']);
        $dWhite = mysqli_real_escape_string($con,$_REQUEST['dWhite']);
        $power1 = mysqli_real_escape_string($con,$_REQUEST['power1']);
        $power2 = mysqli_real_escape_string($con,$_REQUEST['power2']);
        $power3 = mysqli_real_escape_string($con,$_REQUEST['power3']);
        $p1lvl = mysqli_real_escape_string($con,$_REQUEST['p1lvl']);
        $p2lvl = mysqli_real_escape_string($con,$_REQUEST['p2lvl']);
        $p3lvl = mysqli_real_escape_string($con,$_REQUEST['p3lvl']);
        $equippedsupport = mysqli_real_escape_string($con,$_REQUEST['equippedsupport']);
        
        $Champion = 'N';
        if ($p1lvl + $p2lvl + $p3lvl == 13){
            $Champion = 'Y';
        }

        $sqlupd = "UPDATE roster SET
            Name = '" . $name . "',
            Discrimination = '" . $discrimination . "',
            `Level` = " . $level . ",
            `Character` = '" . $character . "',
            Rating = '" . $Rating . "',
            Health = " . $health . ",
            dYellow = " . $dYellow . ",
            dRed = " . $dRed . ",
            dBlue = " . $dBlue . ",
            dPurple = " . $dPurple . ",
            dGreen = " . $dGreen . ",
            dBlack = " . $dBlack . ",
            dCritical = " . $dCritical . ",
            dWhite = " . $dWhite . ",
            Champion = '" . $Champion . "',
            Power1 = '" . $power1 ."',
            Power2 = '" . $power2 ."',
            Power3 = '" . $power3 ."',
            P1Lvl = " . $p1lvl .",
            P2Lvl = " . $p2lvl .",
            P3Lvl = " . $p3lvl . ", 
            equippedsupport = " . $equippedsupport . " 
            WHERE ID = " . $id . ";";
            //echo $sqlupd;

        $runupd = mysqli_query($con,$sqlupd);
        
        if($runupd){
            echo "<script>window.open('heroCRUD.php','_self')</script>";
            $RTsql = "UPDATE  roster_total INNER JOIN roster  ON roster_total.RosterID = roster.ID
                            SET 
                            roster_total.Name = roster.Name,
                            roster_total.Discrimination = roster.Discrimination,
                            roster_total.`Level` = roster.`Level`,
                            roster_total.`Character` = roster.`Character`,
                            roster_total.Rating = roster.Rating,
                            roster_total.Health = roster.Health,
                            roster_total.dYellow = roster.dYellow,
                            roster_total.dRed = roster.dRed,
                            roster_total.dBlue = roster.dBlue,
                            roster_total.dPurple = roster.dPurple,
                            roster_total.dGreen = roster.dGreen,
                            roster_total.dBlack = roster.dBlack,
                            roster_total.dCritical = roster.dCritical,
                            roster_total.dWhite = roster.dWhite,
                            roster_total.Champion = roster.Champion,
                            roster_total.Power1 = roster.Power1,
                            roster_total.P1Lvl = roster.P1Lvl,
                            roster_total.Power2 = roster.Power2,
                            roster_total.P2Lvl = roster.P2Lvl,
                            roster_total.Power3 = roster.Power3,
                            roster_total.P3Lvl = roster.P3Lvl,
                            roster_total.equippedsupport = roster.equippedsupport,
                            roster_total.LastUpdate = roster.LastUpdate";
            $runRTsql = mysqli_query($con,$RTsql);
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