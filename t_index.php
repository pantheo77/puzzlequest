<!DOCTYPE html>
<?php
include 'pqconnect.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <style>
        .dataTables_wrapper {
            font-size: 12px;
            position: relative;
            clear: both;
            *zoom: 1;
            zoom: 1;
        }
    </style>

    <title>PHP CRUD with Bootstrap Modal</title>
</head>
<body>

    <!-- Modal -->
    <div class="modal fade" id="HeroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Hero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="t_insertcode.php" method="POST">
            <div class="form-floating">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                <label for="name">Name:</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="discrimination" id="discrimination" placeholder="Discrimination">
                <label for="discrimination">Discrimination:</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="level" id="level" size="1"  placeholder="Level">
                <label for="level">Level:</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="character" value="Common" checked> Common Character ( * )</label><br>
                <label><input type="radio" name="character" value="Uncommon"> Uncommon Character ( ** )</label><br>
                <label><input type="radio" name="character" value="Rare"> Rare Character ( *** )</label><br>
                <label><input type="radio" name="character" value="Legendary"> Legendary Character ( **** )</label><br>
                <label><input type="radio" name="character" value="Epic"> Epic Character ( ***** )</label><br>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="health" id="health" size="4" placeholder="Health">
                <label for="health">Health:</label>
            </div>
            <div class="row">
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dYellow" id="dYellow" size="1" placeholder="Yellow">
                    <label for="dYellow" class="text-warning">Yellow:</label>
                </div>
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dRed" id="dRed" size="1" placeholder="Red">
                    <label for="dRed" class="text-danger">Red:</label>
                </div>
                <div class="col form-floating">    
                    <input type="text" class="form-control" name="dBlue" id="dBlue" size="1" placeholder="Blue">
                    <label for="dBlue" class="text-primary">Blue:</label>
                </div>
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dPurple" id="dPurple" size="1" placeholder="Purple">
                    <label for="dPurple" style="color:rgb(238, 130, 238);">Purple:</label>
                </div>
            </div>
            <div class="row">
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dGreen" id="dGreen" size="1" placeholder="Green">
                    <label for="dGreen" class="text-success">Green:</label>
                </div>
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dBlack" id="dBlack" size="1" placeholder="Black">
                    <label for="dBlack">Black:</label>
                </div>
                <div class="col form-floating">                
                    <input type="text" class="form-control" name="dCritical" id="dCritical" size="1" placeholder="Critical">
                    <label for="dCritical">Critical:</label>
                </div>
                <div class="col form-floating">  
                    <input type="text" class="form-control" name="dWhite" id="dWhite" size="1" placeholder="White">
                    <label for="dWhite">White:</label>
                </div>
            </div>
            <div class="row">
                <div class="col-9 form-floating">         
                    <input type="text" class="form-control" name="power1" id="power1" placeholder="Power 1">
                    <label for="power1">Power 1:</label>
                </div> 
                <div class="col-3">
                    <select class="form-control" name="p1lvl">
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-9 form-floating">                    
                    <input type="text" class="form-control" name="power2" id="power2" placeholder="Power 2">
                    <label for="power2">Power 2:</label>
                </div>
                <div class="col-3">
                    <select class="form-control" name="p2lvl">
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-9 form-floating">                    
                    <input type="text" class="form-control" name="power3" id="power3" placeholder="Power 3">
                    <label for="power3">Power 3:</label>
                </div>
                <div class="col-3">
                    <select class="form-control" name="p3lvl">
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="Submit" name="insertdata" class="btn btn-primary">Save Data</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <!-- Edit Form ###################################################-->
    <!-- Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Hero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="t_insertcode.php" method="POST">
            <div class="form-floating">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                <label for="name">Name:</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="discrimination" id="discrimination" placeholder="Discrimination">
                <label for="discrimination">Discrimination:</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="level" id="level" size="1"  placeholder="Level">
                <label for="level">Level:</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="character" value="Common" checked> Common Character ( * )</label><br>
                <label><input type="radio" name="character" value="Uncommon"> Uncommon Character ( ** )</label><br>
                <label><input type="radio" name="character" value="Rare"> Rare Character ( *** )</label><br>
                <label><input type="radio" name="character" value="Legendary"> Legendary Character ( **** )</label><br>
                <label><input type="radio" name="character" value="Epic"> Epic Character ( ***** )</label><br>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="health" id="health" size="4" placeholder="Health">
                <label for="health">Health:</label>
            </div>
            <div class="row">
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dYellow" id="dYellow" size="1" placeholder="Yellow">
                    <label for="dYellow" class="text-warning">Yellow:</label>
                </div>
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dRed" id="dRed" size="1" placeholder="Red">
                    <label for="dRed" class="text-danger">Red:</label>
                </div>
                <div class="col form-floating">    
                    <input type="text" class="form-control" name="dBlue" id="dBlue" size="1" placeholder="Blue">
                    <label for="dBlue" class="text-primary">Blue:</label>
                </div>
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dPurple" id="dPurple" size="1" placeholder="Purple">
                    <label for="dPurple" style="color:rgb(238, 130, 238);">Purple:</label>
                </div>
            </div>
            <div class="row">
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dGreen" id="dGreen" size="1" placeholder="Green">
                    <label for="dGreen" class="text-success">Green:</label>
                </div>
                <div class="col form-floating">
                    <input type="text" class="form-control" name="dBlack" id="dBlack" size="1" placeholder="Black">
                    <label for="dBlack">Black:</label>
                </div>
                <div class="col form-floating">                
                    <input type="text" class="form-control" name="dCritical" id="dCritical" size="1" placeholder="Critical">
                    <label for="dCritical">Critical:</label>
                </div>
                <div class="col form-floating">  
                    <input type="text" class="form-control" name="dWhite" id="dWhite" size="1" placeholder="White">
                    <label for="dWhite">White:</label>
                </div>
            </div>
            <div class="row">
                <div class="col-9 form-floating">         
                    <input type="text" class="form-control" name="power1" id="power1" placeholder="Power 1">
                    <label for="power1">Power 1:</label>
                </div> 
                <div class="col-3">
                    <select class="form-control" name="p1lvl">
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-9 form-floating">                    
                    <input type="text" class="form-control" name="power2" id="power2" placeholder="Power 2">
                    <label for="power2">Power 2:</label>
                </div>
                <div class="col-3">
                    <select class="form-control" name="p2lvl">
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-9 form-floating">                    
                    <input type="text" class="form-control" name="power3" id="power3" placeholder="Power 3">
                    <label for="power3">Power 3:</label>
                </div>
                <div class="col-3">
                    <select class="form-control" name="p3lvl">
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="Submit" name="insertdata" class="btn btn-primary">Save Data</button>
            </div>
        </form>
        </div>
    </div>
    </div>
    <!-- Edit Form End ###########################33333-->

    <div class="container">
        <div class="jumbotron">
            <div class="card">
                <h2>Hero List</h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#HeroModal">
                    Add Data
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
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
                                <td class="text-center"><button class="btn btn-primary editbtn">Edit</button><a href="heroCRUD.php?did=<?php echo $id;?>">Delete</a></td> 
                            </tr>
                            
                            <?php 
                                $i++;    
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<!-- Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
<script>$(document).ready(function() {
    $('#dashboard').DataTable( {
    "pageLength": 10,
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
<script>
    $(document).ready(function () {
        $('.editbtn').on('click', function(){
            $('#editmodal').modal('show');
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id').val(data[0]);
            $('#fname').val(data[1]);
            $('#lname').val(data[2]);
            $('#course').val(data[3]);
            $('#contact').val(data[4]);
        });
    });
</script>
</body>
</html>