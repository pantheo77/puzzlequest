<?php 
include 'pqconnect.php';

if(isset($_POST['insertdata'])){
    $Name = mysqli_real_escape_string($con,$_POST['name']);
    $Discrimination = $_POST['discrimination'];
    $Level = $_POST['level'];
    $Character = $_POST['character'];
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
    $Health = $_POST['health'];
    $dYellow =$_POST['dYellow'];
    $dRed = $_POST['dRed'];
    $dBlue = $_POST['dBlue'];
    $dPurple = $_POST['dPurple'];
    $dGreen = $_POST['dGreen'];
    $dBlack = $_POST['dBlack'];
    $dCritical = $_POST['dCritical'];
    $dWhite = $_POST['dWhite'];
    $Power1 = $_POST['power1'];
    $P1Lvl = $_POST['p1lvl'];
    $Power2 = $_POST['power2'];
    $P2Lvl = $_POST['p2lvl'];
    $Power3 = $_POST['power3'];
    $P3Lvl = $_POST['p3lvl'];
    $Champion = "N";
    if($P1Lvl + $P2Lvl + $P3Lvl == 13){
        $Champion = "Y";
    } 
    $sql = "INSERT INTO roster_total(Name,Discrimination,`Level`,`Character`,Rating,Health,dYellow,dRed,dBlue,dPurple,dGreen,dBlack,dCritical,dWhite,Champion,Power1,P1Lvl,Power2,P2Lvl,Power3,P3Lvl,equippedsupport) VALUES('$Name','$Discrimination','$Level','$Character','$Rating','$Health','$dYellow','$dRed','$dBlue','$dPurple','$dGreen','$dBlack','$dCritical','$dWhite','$Champion','$Power1','$P1Lvl','$Power2','$P2Lvl','$Power3','$P3Lvl',0)";
    echo $sql;
    
    $run = mysqli_query($con,$sql);
    
    if($run){
        echo '<div class="alert alert-success" id="success-alert"><strong>Success!</strong> Record created.</div>';
        
        //insert new character into ratings
        $last_id = mysqli_insert_id($con);
        $insertsql = "INSERT INTO mpqratings(mpqratings.Place,mpqratings.NAME,mpqratings.Stars,mpqratings.Ranking,mpqratings.TotalRosterID)
        SELECT (SELECT MAX(mpqratings.place)+1 FROM mpqratings),CONCAT(roster_total.NAME,' (',roster_total.Discrimination,')'),CONCAT(CHAR_LENGTH(roster_total.Rating),'*'),'U',roster_total.ID FROM roster_total WHERE roster_total.id = " . $last_id;
        $run_insert = mysqli_query($con,$insertsql);    
        echo '<script> alert("Data Saved"); </script>';
        header('Location: t_index.php');       
    } else {
        echo '<div class="alert alert-danger" id="danger-alert"><strong>Something went wrong!</strong> Record created.</div>';
        echo '<script> alert("Data Not Saved"); </script>';
        echo $sql;
    }
    
}
?>