<?php 
require_once "pqconnect.php"

if(isset($_POST['action'])){
    switch($_POST['action']){
        case 'update':
            $id = mysqli_real_escape_string($con,$_REQUEST['id']);
            $name =  mysqli_real_escape_string($con,$_REQUEST['name']);
            $discrimination =  mysqli_real_escape_string($con,$_REQUEST['discrimination']);
            $level =  mysqli_real_escape_string($con,$_REQUEST['level']);
            $character =  mysqli_real_escape_string($con,$_REQUEST['character']);
            $health =  mysqli_real_escape_string($con,$_REQUEST['health']);
            $dYellow =  mysqli_real_escape_string($con,$_REQUEST['dYellow']);
            $dRed =  mysqli_real_escape_string($con,$_REQUEST['dRed']);
            $dBlue =  mysqli_real_escape_string($con,$_REQUEST['dBlue']);
            $dPurple =  mysqli_real_escape_string($con,$_REQUEST['dPurple']);
            $dGreen =  mysqli_real_escape_string($con,$_REQUEST['dGreen']);
            $dBlack =  mysqli_real_escape_string($con,$_REQUEST['dBlack']);
            $dCritical =  mysqli_real_escape_string($con,$_REQUEST['dCritical']);
            $dWhite =  mysqli_real_escape_string($con,$_REQUEST['dWhite']);
            $power1 =  mysqli_real_escape_string($con,$_REQUEST['power1']);
            $power2 =  mysqli_real_escape_string($con,$_REQUEST['power2']);
            $power3 =  mysqli_real_escape_string($con,$_REQUEST['power3']);
            $equippedsupport =  mysqli_real_escape_string($con,$_REQUEST['equippedsupport']);
            
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

            $Champion = 'N';
            if ($power1 + $power2 + $power3 == 13){
                $Champion = 'Y';
            }
            $i = 0;
            if($id == ''){
                echo '<div class="alert alert-danger" id="success-alert"><strong>Failed!</strong> Criteria field should not be empty.</div>';  
                $i++;
            }
            
            if($i == 0){
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

                $runupd = mysqli_query($con,$sqlupd);
                if($runupd){
                    echo "Updated successfully";
                }

            }
    }
    break;
    
}
?>