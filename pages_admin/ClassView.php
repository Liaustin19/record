<!DOCTYPE html>
<?php 
include("header.php");
require_once '../db_connect.php';
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Department Records</title>
        <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.addons.css">
        <link rel="stylesheet" href="/record/css/font_awesome/fontawesome-4.3.0.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
                                                <h2 style="float:left">Filter Department</h2>				
                                            </div>
                                            <form class="forms-sample" method="post">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Department Name" name="className">
                                                        </div>
                                                    </div>
                                                    <!-- <script>
                                                        var controllerTypeFunctions = {
                                                            Default:function(){
                                                                $('#form option').prop('disabled',false);   
                                                            },
                                                            Lower: function(){
                                                                $('#form option').filter(function(){
                                                                    return this.value == "4" || this.value == "5"
                                                                }).prop('disabled',true);   
                                                            },
                                                            UpperScience: function(){
                                                                $('#form option').filter(function(){
                                                                    return this.value == "1" || this.value == "2" || this.value == "3"
                                                                }).prop('disabled',true);   
                                                            },
                                                            UpperArt: function(){
                                                                $('#form option').filter(function(){
                                                                    return this.value == "1" || this.value == "2" || this.value == "3"
                                                                }).prop('disabled',true);   
                                                            } 
                                                        }

                                                        $('#grade').on('change',function(){
                                                            controllerTypeFunctions.Default();

                                                            var val = $(this).val();
                                                            controllerTypeFunctions[val]();
                                                        });
                                                        $(document).ready(function(){
                                                            $('[data-toggle="tooltip"]').tooltip();   
                                                        });
                                                    </script> -->
                                                </div>
                                                <button type="submit" class="btn btn-dark mr-2" name="search">Submit</button>
                                                <button class="btn btn-light" name="cancel" type="reset">Cancel</button>
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
                                        <h2 style="float:left">Department Details</h2>
                                        <a href="ClassAdd.php" class="btn btn-dark pull-right" style="float: right">Add New Department</a>
                                    </div>

                                    <?php 
                                    $sql = "SELECT * FROM dep ";
                                    $result = $conn->query($sql); 
                                    $rownum = $result->num_rows; 
                                    if (isset($_POST['search'])){ 
                                        $sql = "SELECT * FROM dep "; 
                                        $where = ""; 
                                        $limit = "";
                                        if (!empty($_POST["className"])){ 
                                            if(!empty($where))
                                                $where .= " AND ";
                                            $where .= "depname LIKE '%{$_POST["className"]}%' "; 
                                        }
                                        if (!empty($where)) {
                                            $sql .= "WHERE " . $where; 
                                        }
                                        if (!empty($limit)){
                                            $sql .= " " . $limit; 
                                        }
                                        $result = $conn->query($sql); 
                                        $rownum = $result->num_rows; 
                                    }
                                    ?>

                                    <div class="table-responsive">
                                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">S/N</th>
                                                    <th class="border-top-0">Department Name</th>
                                                    <th class="border-top-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i=0;
                                        while ($row = $result->fetch_assoc())
                                        { $i++;
                                            echo 
                                                '<tr>
                                                    <td>'.$i.'</td>
                                                    <td>'.$row['depname'].'</td>

                                                    <td><a href="ClassUpdate.php?id='.$row['id'].'" title="Update Department" data-toggle="tooltip" class="icon"><i class="fa fa-edit icon"></i></a></td>

                                                </tr>';
                                        }
                                        echo "<tfoot class='foot'><td colspan='6'><div id='records'>".$rownum. " records found</div></td></tfoot>";
                                                ?>
                                            </tbody>
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
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
        <script src="../vendors/js/vendor.bundle.base.js"></script>
        <script src="../vendors/js/vendor.bundle.addons.js"></script>
        <script src="../js/off-canvas.js"></script>
        <script src="../js/misc.js"></script>
    </body>
</html>