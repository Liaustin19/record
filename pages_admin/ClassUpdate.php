<!DOCTYPE html>
<?php 
include("header.php");
require_once '../db_connect.php';
$id = $_GET["id"];

$namesql = 'SELECT * FROM dep WHERE id="'.$id. '"'; 
$result = $conn->query($namesql); 
$row = $result->fetch_assoc();

?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Update Department Records</title>
        <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="/record/css/font_awesome/fontawesome-4.3.0.min.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.addons.css">
        <link rel="stylesheet" href="../vendors/icheck/skins/all.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" href="../images/favicon.png" />
    </head>

    <body>
        <div class="container-scroller">
            <?php 
            include("nav.php"); 
            ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-stretch grid-margin">
                            <div class="row flex-grow">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="page-header clearfix">
                                                <h2 style="float:left">Update Department</h2>				
                                            </div>
                                            <form class="forms-sample" method="post">
                                                <?php
                                                if (isset($errMSG)) {
                                                ?>
                                                <div class="form-group">
                                                    <div class="alert alert-danger alert-icon-left alert-arrow-left alert-info mb-2" role="alert">
                                                        <span class="alert-icon"><i class="fa fa-info"></i></span> <?php echo $errMSG; ?>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="form-group">
                                                    <label for="className">Department Name</label>
                                                    <input type="text" class="form-control" placeholder="" name="className" id="className" value="<?php echo $row['depname']; ?>" required>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-dark mr-2" name="update">Update</button>
                                                <button class="btn btn-light" name="Delete">Delete</button>
                                                <?php 
                                                if (isset($_POST['update'])){ 
                                                    $classID = trim($id);
                                                    $className = trim($_POST['className']);

                                                    $classID = str_replace( "'", "'", $classID); 
                                                    $className = str_replace( "'", "'", $className); 

                                                    $err = true;

                                                    if($err){
                                                        $sql = 'UPDATE dep SET 
														depname = "'.$className.'"
														WHERE id ="'.$id.'";';

                                                        if ($result = $conn->query($sql)) {
                                                            $scMSG = "Updated successfully";
                                                            echo "<script> alert('Department Updated Successfully!'); location.href='ClassView.php'; </script>";
                                                        } 
                                                        else {
                                                            $errMSG = mysqli_error($conn);
                                                        }	
                                                    }
                                                }
                                                if (isset($_POST['Delete'])){ 
                                                    $dsql = 'DELETE FROM dep WHERE id = "'.$id. '"'; 
                                                    if ($result = $conn->query($dsql)) {
                                                        $scMSG = "Deleted successfully";
                                                        echo "<script> alert('Department Deleted Successfully!'); location.href='ClassView.php'; </script>";
                                                    } 
                                                    else {
                                                        $errMSG = mysqli_error($conn);
                                                    }	
                                                }
                                                echo '<br/><br/>';

                                                if (isset($errMSG)) {
                                                ?>
                                                <div class="form-group">
                                                    <div class="alert alert-danger alert-icon-left alert-arrow-left alert-info mb-2" role="alert">
                                                        <span class="alert-icon"><i class="fa fa-info"></i></span> <?php echo $errMSG; ?>
                                                    </div>
                                                </div>
                                                <?php
                                                }

                                                if (isset($scMSG)) {

                                                ?>
                                                <div class="form-group">
                                                    <div class="alert alert-success alert-icon-left alert-arrow-left alert-info mb-2" role="alert">
                                                        <span class="alert-icon"><i class="fa fa-info"></i></span> <?php echo $scMSG; ?>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </div>
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
    </body>
</html>