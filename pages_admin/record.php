<!DOCTYPE html>
<?php 
include("header.php");
require_once '../db_connect.php';
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Records</title>
        <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.addons.css">
        <link rel="stylesheet" href="/record/css/font_awesome/fontawesome-4.3.0.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" href="../images/favicon.png" />
        <style>
            .icon{
                color: #e24826;
            }
            .icon:hover{
                color: #d3323a;
            }
        </style>
    </head>
    <body>
        <div class="container-scroller">
            <?php 
            include("nav.php"); 
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-stretch grid-margin">
                            <div class="row flex-grow">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="page-header clearfix">
                                                <h2 style="float:left">Filter Record</h2>				
                                            </div>
                                            <form class="forms-sample" method="post">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select name="sessn" class="form-control" id="sessn">
                                                                <option value="">-- select session --</option>
                                                                <?php
                                                                $i = 2016;
                                                                $b = 2016;
                                                                $day = date('Y');
                                                                for ($i; $i <= $day; $i++) { $b++;
                                                                    echo "<option value='".$i."/".$b."'>".$i."/".$b."</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select name="semes" class="form-control" id="semes">
                                                                <option value="">-- select semester --</option>
                                                                <option value="FIRST">FIRST</option>
                                                                <option value="SECOND">SECOND</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select name="classes" class="form-control" id="classes" onchange="fetchRecs();">
                                                                <option value="">-- select class --</option>
                                                                <?php
                                                                $ql = mysqli_query($conn, "SELECT * FROM class");
                                                                while ($r = mysqli_fetch_array($ql)) {
                                                                    ?>
                                                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['classname']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="page-header clearfix">
                                        <h2 style="float:left">Record Details</h2>
                                        <!-- <a href="subjectAdd.php" class="btn btn-dark pull-right" style="float: right">Add New Course</a> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">S/N</th>
                                                    <th class="border-top-0">Name</th>
                                                    <th class="border-top-0">Course Title</th> 
                                                    <th class="border-top-0">Course Code</th>
                                                    <th class="border-top-0">Class</th>   
                                                    <th class="border-top-0">Question</th> 
                                                    <th class="border-top-0">Answer</th> 
                                                    <th class="border-top-0">D/S</th> 
                                                    <th class="border-top-0">D/C</th>
                                                </tr>
                                            </thead>
                                            <tbody id="allRest"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                include("../footer.php"); 
                ?>
            </div>
        </div>
        <script src="../vendors/js/vendor.bundle.base.js"></script>
        <script src="../vendors/js/vendor.bundle.addons.js"></script>
        <script src="../js/off-canvas.js"></script>
        <script src="../js/misc.js"></script>

        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
            
            function recMan(rectype, initval, userRec, classidRec, courseidRec, sessionRec, semesterRec) {
                $.ajax({
                    method: 'POST',
                    url: 'process.php',
                    data: {
                        procRecord: 1,
                        userRec: userRec,
                        classidRec: classidRec,
                        courseidRec: courseidRec,
                        sessionRec: sessionRec,
                        semesterRec: semesterRec,
                        rectype: rectype,
                        initval: initval
                    },
                    success: function(res) {
                        alert(res);
                        fetchRecs();
                    },
                    dataType: 'text'
                });
            }

            function fetchRecs() {
                let sessn = $('#sessn').val(),
                semes = $('#semes').val(),
                classes = $('#classes').val();
                $.ajax({
                    method: 'POST',
                    url: 'process.php',
                    data: {
                        search: 1,
                        sessn: sessn,
                        semes: semes,
                        classes: classes
                    },
                    success: function(res) {
                        $('#allRest').html(res);
                    },
                    dataType: 'text'
                });
            }
        </script>
    </body>
</html>