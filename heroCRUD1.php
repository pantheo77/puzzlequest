<!DOCTYPE html>
<?php 
    include 'pqconnect.php';
    
?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/style.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
    <!-- Popper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    
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
    
    <script src="./scripts/main.js"></script>
        
    <style>
        .dataTables_wrapper {
            font-size: 12px;
            position: relative;
            clear: both;
            *zoom: 1;
            zoom: 1;
        }
    </style>
    <script type="text/javascript">
            $(".submit_edit").on('click', function(e){
                var edit_id = $("#edit_id").val();
                var edit_name = $("#edit_name").val();
                var edit_discrimination = $("#edit_discrimination").val();
                var edit_level = $("#edit_level").val();
                var edit_character = $("#edit_character").val();
                var edit_health = $("#edit_health").val();
                var edit_dYellow = $("#edit_dYellow").val();
                var edit_dRed = $("#edit_dRed").val();
                var edit_dBlue = $("#edit_dBlue").val();
                var edit_dPurple = $("#edit_dPurple").val();
                var edit_dGreen = $("#edit_dGreen").val();
                var edit_dBlack = $("#edit_dBlack").val();
                var edit_dCritical = $("#edit_dCritical").val();
                var edit_dWhite = $("#edit_dWhite").val();
                var edit_power1 = $("#edit_power1").val();
                var edit_power2 = $("#edit_power2").val();
                var edit_power3 = $("#edit_power3").val();
                var edit_equippedsupport = $("#edit_equippedsupport").val();
                var ajaxurl = 'hero_edit.php',
                data = {'action':'update'
                        ,'id':edit_id
                        ,'name':edit_name
                        ,'discrimination':edit_discrimination
                        ,'level':edit_level
                        ,'character':edit_character
                        ,'health':edit_health
                        ,'dYellow':edit_dYellow
                        ,'dRed':edit_dRed
                        ,'dBlue':edit_dBlue
                        ,'dPurple':edit_dPurple
                        ,'dGreen':edit_dGreen
                        ,'dBlack':edit_dBlack
                        ,'dCritical':edit_dCritical
                        ,'dWhite':edit_dWhite
                        ,'power1':edit_power1
                        ,'power2':edit_power2
                        ,'power3':edit_power3
                        ,'equippedsupport':edit_equippedsupport};
                $.post(ajaxurl, data, function(response){
                    $('#modalContactForm'+edit_id).modal('hide');
                    alert(response);
                    location.reload(true);
                });
            });
    </script>

    
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
                <th>Power 1 - (Level)</th>
                <!--<th>Power 2 - (Level)</th>
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
                    $equippedSupport = $row['equippedsupport'];
                    $lastupdate = $row['LastUpdate'];
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
                <td><button class='btn btn-info' data-toggle='modal' data-id='<?php echo $id; ?>' data-target='#modalContactForm<?php echo $id; ?>'>Edit</button></td> 
                <!--<td><?php echo $Power2 . " - "; ?><strong style="font-size:1.15em;">(<?php echo $P2Lvl; ?>)</strong></td> 
                <td><?php echo $Power3 . " - "; ?><strong style="font-size:1.15em;">(<?php echo $P3Lvl; ?>)</strong></td>--> 
                <td class="text-center"><a href="heroCRUD.php?did=<?php echo $id;?>">Delete</a></td> 
            </tr>
            <div class="modal fade" id="modalContacForm<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h2 class="modal-title font-weight-bold">Edit Hero</h2>
                            </div>
                            <div>
                                <div class="form-group">
                                    <input type="hidden" value="<?php echo $id; ?>" name="edit_id" id="edit_id">
                                    <label for="edit_name">Name:</label>
                                    <input type="text" class="form-control" name="edit_name" id="edit_name" value="<?php echo $Name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="edit_discrimination">Discrimination:</label>
                                    <input type="text" class="form-control" name="edit_discrimination" id="edit_discrimination" value="<?php echo $Discrimination; ?>">
                                </div>
                                <div class="form-inline">
                                    <label for="edit_level">Level:</label>
                                    <input type="text" class="form-control" name="edit_level" id="edit_level" size="1" value="<?php echo $Level; ?>">
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="edit_character" id="edit_character" value="Common" <?php if($Character == 'Common'){ echo 'checked'; } ?>> Common Character ( * )</label><br>
                                    <label><input type="radio" name="edit_character" id="edit_character" value="Uncommon" <?php if($Character == 'Uncommon'){ echo 'checked'; } ?>> Uncommon Character ( ** )</label><br>
                                    <label><input type="radio" name="edit_character" id="edit_character" value="Rare" <?php if($Character == 'Rare'){ echo 'checked'; } ?>> Rare Character ( *** )</label><br>
                                    <label><input type="radio" name="edit_character" id="edit_character" value="Legendary" <?php if($Character == 'Legendary'){ echo 'checked'; } ?>> Legendary Character ( **** )</label><br>
                                    <label><input type="radio" name="edit_character" id="edit_character" value="Epic" <?php if($Character == 'Epic'){ echo 'checked'; } ?>> Epic Character ( ***** )</label><br>
                                </div>
                                <div class="form-inline">
                                    <label for="edit_health">Health:</label>
                                    <input type="text" class="form-control" name="edit_health" id="edit_health" size="4" value="<?php echo $Health; ?>">
                                </div>
                                Damage<br>
                                <div class="form-inline" style="margin-bottom:5px">
                                    <label for="edit_dYellow" class="text-warning">Yellow:</label>
                                    <input type="text" class="form-control" name="edit_dYellow" id="edit_dYellow" size="1" value="<?php echo $dYellow; ?>">
                                    <label for="edit_dRed" class="text-danger">Red:</label>
                                    <input type="text" class="form-control" name="edit_dRed" id="edit_dRed" size="1" value="<?php echo $dRed; ?>">
                                    <label for="edit_dBlue" class="text-primary">Blue:</label>
                                    <input type="text" class="form-control" name="edit_dBlue" id="edit_dBlue" size="1" value="<?php echo $dBlue; ?>">
                                    <label for="edit_dPurple" style="color:rgb(238, 130, 238);">Purple:</label>
                                    <input type="text" class="form-control" name="edit_dPurple" id="edit_dPurple" size="1" value="<?php echo $dPurple; ?>">
                                </div>
                                <div class="form-inline"  style="margin-bottom:5px">
                                    <label for="dGreen" class="text-success">Green:</label>
                                    <input type="text" class="form-control" name="edit_dGreen" id="edit_dGreen" size="1" value="<?php echo $dGreen; ?>">
                                    <label for="edit_dBlack">Black:</label>
                                    <input type="text" class="form-control" name="edit_dBlack" id="edit_dBlack" size="1" value="<?php echo $dBlack; ?>">
                                    <label for="edit_dCritical">Critical:</label>
                                    <input type="text" class="form-control" name="edit_dCritical" id="edit_dCritical" size="1"  value="<?php echo $dCritical; ?>">
                                    <label for="dWhite" class="text-light bg-dark">White:</label>
                                    <input type="text" class="form-control" name="edit_dWhite" id="edit_dWhite" size="1"  value="<?php echo $dWhite; ?>">
                                </div>
                                <div class="form-inline"  style="margin-bottom:5px">
                                    <label for="edit_power1">Power 1:</label>
                                    <input type="text" class="form-control" name="edit_power1" id="edit_power1" value="<?php echo $Power1; ?>">
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
                                    <label for="edit_power2">Power 2:</label>
                                    <input type="text" class="form-control" name="edit_power2" id="edit_power2" value="<?php echo $Power2; ?>">
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
                                    <label for="edit_power3">Power 3:</label>
                                    <input type="text" class="form-control" name="edit_power3" id="edit_power3" value="<?php echo $Power3; ?>">
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
                                    <label for="edit_equippedsupport">Equipped Support:</label>
                                    <select class="form-control" name="edit_equippedsupport" id="edit_equippedsupport">
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
                                        <input type="submit" name="update" value="Edit Hero" class="submit_edit btn btn-dark"></input>
                                        <input type="button" name="close" value="Close" class="btn btn-danger" data-dismiss="modal"></input>
                                    </div>
                                </div>
                                <div>
                                    <h5>(Last Updated on: <?php echo date("d M Y, H:i:s",strtotime($lastupdate)); ?>)</h5>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <?php 
                $i++;    
                }
            ?>
        </tbody>
    </table>

</div> 
    <?php 
    if(isset($_GET['did'])){
        $did = $_GET['did'];
        $delete = "DELETE FROM roster WHERE ID = " . $did;
        $run_delete = mysqli_query($con,$delete);
    
        if($run_delete){
                echo "<script>window.open('heroCRUD.php','_self')</script>";
            }
    }
    ?>
    </div>
    <!--
    <div class="container">
        <div class="row">
            
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
                    ?>
            
    
</body>
</html>