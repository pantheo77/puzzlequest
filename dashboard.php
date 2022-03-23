<!DOCTYPE html>
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
    
    <title>Dashboard</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <div class="row">Dashboard</div>
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
            <div class="col border">
                <?php
                    $champ = 0;
                    $csql = "SELECT COUNT(Champion) AS ct_champ FROM roster WHERE Champion = 'Y'" ;
                    $crun = mysqli_query($con,$csql);
                    while($crow = mysqli_fetch_array($crun)){
                        $champ = $crow['ct_champ'];
                    };

                ?>
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
                                "options": { responsive: true,
                                            legend: {display: true}, 
                                            title: {display: true, text:"Cover Ratings"} }
                    });

            </script>
            </div>
            <div class="col border rounded">
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
                                "options": {  responsive: true,
                                            legend: {display: true},
                                            title: {display: true, text:"Heroes Development"} }
                    });

                </script>
            </div>
            <div class="col border">
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
                                "options": {  responsive: true,
                                            legend: {display: true},
                                            title: {display: true, text:"Total Heroes"} }
                    });

                </script>
            </div>
        </div>
        <div class="row">
            <div class="col border border-3 rounded">
                    <canvas id="pie-heroes" width="200" height="200"></canvas>
                    <script>
                        var ctx = document.getElementById('pie-heroes');
                        var myChart = new Chart(ctx,
                            {
                                "type":"pie",
                                "data":{
                                    "labels":["Overall Yay", 'Overall Nay', 'Group A Yay', 'Group A Nay', 'Group B Yay', 'Group B Nay', 'Group C Yay', 'Group C Nay'],
                                }
                            });
                    </script>
            </div>
        </div>
    </div>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
    <!-- Popper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    
    <!-- <script>$(document).ready(function() {
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
    </script> -->
    
    
    
</body>
</html>