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

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <title>Insert Hero</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h1 class="text-center">Insert New Hero</h1>
        <form action="insertForm.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="discrimination">Discrimination:</label>
                <input type="text" class="form-control" name="discrimination" id="discrimination">
            </div>
            <div class="form-inline">
                <label for="level">Level:</label>
                <input type="text" class="form-control" name="level" id="level" size="1" value="0">
            </div>
            <div class="radio">
                <label><input type="radio" name="character" value="Common" checked> Common Character ( * )</label><br>
                <label><input type="radio" name="character" value="Uncommon"> Uncommon Character ( ** )</label><br>
                <label><input type="radio" name="character" value="Rare"> Rare Character ( *** )</label><br>
                <label><input type="radio" name="character" value="Legendary"> Legendary Character ( **** )</label><br>
                <label><input type="radio" name="character" value="Epic"> Epic Character ( ***** )</label><br>
            </div>
            <div class="form-inline">
                <label for="health">Health:</label>
                <input type="text" class="form-control" name="health" id="health" size="4" value="0">
            </div>
            Damage<br>
            <div class="form-inline" style="margin-bottom:5px">
                <label for="dYellow" class="text-warning">Yellow:</label>
                <input type="text" class="form-control" name="dYellow" id="dYellow" size="1" value="0">
                <label for="dRed" class="text-danger">Red:</label>
                <input type="text" class="form-control" name="dRed" id="dRed" size="1" value="0">
                <label for="dBlue" class="text-primary">Blue:</label>
                <input type="text" class="form-control" name="dBlue" id="dBlue" size="1" value="0">
                <label for="dBlue" style="color:rgb(238, 130, 238);">Purple:</label>
                <input type="text" class="form-control" name="dPurple" id="dPurple" size="1" value="0">
            </div>
            <div class="form-inline"  style="margin-bottom:5px">
                <label for="dBlue" class="text-success">Green:</label>
                <input type="text" class="form-control" name="dGreen" id="dGreen" size="1" value="0">
                <label for="dBlack">Black:</label>
                <input type="text" class="form-control" name="dBlack" id="dBlack" size="1" value="0">
                <label for="dCritical">Critical:</label>
                <input type="text" class="form-control" name="dCritical" id="dCritical" size="1" value="0">
                <label for="dBlack" class="text-light bg-dark">White:</label>
                <input type="text" class="form-control" name="dWhite" id="dWhite" size="1" value="0">
            </div>
            <div class="form-inline"  style="margin-bottom:5px">
                <label for="power1">Power 1:</label>
                <input type="text" class="form-control" name="power1" id="power1">
                <label for="p1lvl">Level:</label>
                <select class="form-control" name="p1lvl">
                    <option value="0" selected="selected">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-inline"  style="margin-bottom:5px">
                <label for="power2">Power 2:</label>
                <input type="text" class="form-control" name="power2" id="power2">
                <label for="p2lvl">Level:</label>
                <select class="form-control" name="p2lvl">
                    <option value="0" selected="selected">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-inline" style="margin-bottom:5px">
                <label for="power3">Power 3:</label>
                <input type="text" class="form-control" name="power3" id="power3">
                <label for="p3lvl">Level:</label>
                <select class="form-control" name="p3lvl">
                    <option value="0" selected="selected">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <div class="text-center">
                    <input type="submit" name="submit" value="Insert New Hero" class="btn btn-dark">
                </div>
            </div>
            
        </form> 
    </div>
    
    <?php 
    if(isset($_POST['submit'])){
        $Name = mysqli_real_escape_string($con,$_POST['name']);
        $Discrimination = mysqli_real_escape_string($con,$_POST['discrimination']);
        $Level = mysqli_real_escape_string($con,$_POST['level']);
        $Character = mysqli_real_escape_string($con,$_POST['character']);
        switch($Character){
            case "Common":
                $Rating = "*";
                break;
            case "Uncommon":
                $Rating = "**";
                break;
            case "Rare":
                $Rating = "***";
                break;
            case "Legendary":
                $Rating = "****";
                break;
            case "Epic":
                $Rating = "*****";
                break;
        }
        $Health = mysqli_real_escape_string($con,$_POST['health']);
        $dYellow = mysqli_real_escape_string($con,$_POST['dYellow']);
        $dRed = mysqli_real_escape_string($con,$_POST['dRed']);
        $dBlue = mysqli_real_escape_string($con,$_POST['dBlue']);
        $dPurple = mysqli_real_escape_string($con,$_POST['dPurple']);
        $dGreen = mysqli_real_escape_string($con,$_POST['dGreen']);
        $dBlack = mysqli_real_escape_string($con,$_POST['dBlack']);
        $dCritical = mysqli_real_escape_string($con,$_POST['dCritical']);
        $dWhite = mysqli_real_escape_string($con,$_POST['dWhite']);
        $Power1 = mysqli_real_escape_string($con,$_POST['power1']);
        $P1Lvl = mysqli_real_escape_string($con,$_POST['p1lvl']);
        $Power2 = mysqli_real_escape_string($con,$_POST['power2']);
        $P2Lvl = mysqli_real_escape_string($con,$_POST['p2lvl']);
        $Power3 = mysqli_real_escape_string($con,$_POST['power3']);
        $P3Lvl = mysqli_real_escape_string($con,$_POST['p3lvl']);
        $Champion = "N";
        if($P1Lvl + $P2Lvl + $P3Lvl == 13){
            $Champion = "Y";
        } 
        $sql = "INSERT INTO roster_total(Name,Discrimination,`Level`,`Character`,Rating,Health,dYellow,dRed,dBlue,dPurple,dGreen,dBlack,dCritical,dWhite,Champion,Power1,P1Lvl,Power2,P2Lvl,Power3,P3Lvl,equippedsupport) VALUES('$Name','$Discrimination','$Level','$Character','$Rating','$Health','$dYellow','$dRed','$dBlue','$dPurple','$dGreen','$dBlack','$dCritical','$dWhite','$Champion','$Power1','$P1Lvl','$Power2','$P2Lvl','$Power3','$P3Lvl',0)";
        //echo $sql;
        
        $run = mysqli_query($con,$sql);
        
        if($run){
            echo '<div class="alert alert-success" id="success-alert"><strong>Success!</strong> Record created.</div>';
            
            //insert new character into ratings
            $last_id = mysqli_insert_id($con);
            $insertsql = "INSERT INTO mpqratings(mpqratings.Place,mpqratings.NAME,mpqratings.Stars,mpqratings.Ranking,mpqratings.TotalRosterID)
            SELECT (SELECT MAX(mpqratings.place)+1 FROM mpqratings),CONCAT(roster_total.NAME,' (',roster_total.Discrimination,')'),CONCAT(CHAR_LENGTH(roster_total.Rating),'*'),'U',roster_total.ID FROM roster_total WHERE roster_total.id = " . $last_id;
            $run_insert = mysqli_query($con,$insertsql);            
        } else {
            echo '<div class="alert alert-danger" id="danger-alert"><strong>Something went wrong!</strong> Record created.</div>';
            echo $sql;
        }
        
    }
    ?>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(".alert").delay(4000).slideUp(200, function() {
        $(this).alert('close');
        });
    </script>
</body>
</html>