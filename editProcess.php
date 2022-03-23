<?php
    include 'pqconnect.php';

    $Rating = '';
    if($_REQUEST['character'] == "Common"){
        $Rating = '*';
    } elseif($_REQUEST['character'] == "Uncommon"){
        $Rating = '**';
    } elseif($_REQUEST['character'] == "Rare"){
        $Rating = '***';
    } elseif($_REQUEST['character'] == "Legendary"){
        $Rating = '****';
    } elseif($_REQUEST['character'] == "Epic"){
        $Rating = '*****';
    } 
    
    $Champion = 'N';
    if ($_REQUEST['p1lvl'] + $_REQUEST['p2lvl'] + $_REQUEST['p3lvl'] == 13){
        $Champion = 'Y';
    }
    
    $sql = "UPDATE roster SET
        Name = '" . $_REQUEST['name'] . "',
        Discrimination = '" . $_REQUEST['discrimination'] . "',
        `Level` = " . $_REQUEST['level'] . ",
        `Character` = '" . $_REQUEST['character'] . "',
        Rating = '" . $Rating . "',
        Health = " . $_REQUEST['health'] . ",
        dYellow = " . $_REQUEST['dYellow'] . ",
        dRed = " . $_REQUEST['dRed'] . ",
        dBlue = " . $_REQUEST['dBlue'] . ",
        dPurple = " . $_REQUEST['dPurple'] . ",
        dGreen = " . $_REQUEST['dGreen'] . ",
        dBlack = " . $_REQUEST['dBlack'] . ",
        dCritical = " . $_REQUEST['dCritical'] . ",
        dWhite = " . $_REQUEST['dWhite'] . ",
        Champion = '" . $Champion . "',
        Power1 = '" . $_REQUEST['power1'] ."',
        Power2 = '" . $_REQUEST['power2'] ."',
        Power3 = '" . $_REQUEST['power3'] ."',
        P1Lvl = " . $_REQUEST['p1lvl'] .",
        P2Lvl = " . $_REQUEST['p2lvl'] .",
        P3Lvl = " . $_REQUEST['p3lvl'] . " 
        WHERE ID = " . $_REQUEST['id'] . ";";
        //echo $sql;

        $run = mysqli_query($con,$sql);
    
    ?>