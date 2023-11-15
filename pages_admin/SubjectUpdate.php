<?php 
include("header.php");
require_once '../db_connect.php';
$id = $_GET["id"];

$namesql = 'SELECT * FROM subject WHERE subjectID="'.$id. '"'; 
$result = $conn->query($namesql); 
$row = $result->fetch_assoc();
        
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Add Course</title>
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
                                                <h2 style="float:left">Update Course</h2>				
                                            </div>
                                            <form class="forms-sample" method="post" action="#">
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
                                                    <br/>
                                                    <label for="subjectID">Course Code</label>
                                                    <input type="text" class="form-control" placeholder="" name="subjectID" id="subjectID" value="<?php echo $id; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subjectName">Course Title</label>
                                                    <input type="text" class="form-control" placeholder="" name="subjectName" id="subjectName" value="<?php echo $row['subjectName']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Course Class</label>
                                                    <select name="subjectType" class="form-control">
                                                    <?php 
                                                    $req = mysqli_query($conn, "SELECT * FROM class");
                                                    while ($rr = mysqli_fetch_array($req)) { ?>
                                                        <option value="<?php echo $rr['id'] ?>" <?php if ($row['subjectType'] == $rr['id']) { echo 'selected'; } ?>> <?php echo $rr["classname"]; ?> </option>
                                                    <?php }
                                                    ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Course Semester</label>
                                                    <select name="semester" class="form-control">
                                                        <option value="">Course Semester</option>
                                                        <option value="FIRST" <?php if ($row['semester'] == 'FIRST') { echo 'selected'; } ?>>FIRST</option>
                                                        <option value="SECOND" <?php if ($row['semester'] == 'SECOND') { echo 'selected'; } ?>>SECOND</option>
                                                    
                                                    
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-dark mr-2" name="Update">Update</button>
                                                <button class="btn btn-light" name="Delete">Delete</button>
                                                <?php 
                                                if (isset($_POST['Update'])){ 
                                                    $subjectID = trim($_POST['subjectID']);
                                                    $subjectName = trim($_POST['subjectName']);
                                                    $subjectType = trim($_POST['subjectType']);
                                                    $semester = trim($_POST['semester']);

                                                    $subjectID = str_replace( "'", "'", $subjectID); 
                                                    $subjectName = str_replace( "'", "'", $subjectName); 
                                                    $subjectType = str_replace( "'", "'", $subjectType); 
                                                    $semester = str_replace( "'", "'", $semester); 

                                                    $sql = 'UPDATE subject SET
														subjectID = "'.$subjectID.'",
														subjectName = "'.$subjectName.'",
														subjectType = "'.$subjectType.'",
														semester = "'.$semester.'"
														WHERE subjectID ="'.$id.'";';

                                                    if ($result = $conn->query($sql)) {
                                                        $scMSG = "Updated successfully";
                                                        echo "<script> alert('Course Updated Successfully!'); location.href='SubjectView.php'; </script>";
                                                    } 
                                                    else {
                                                        $errMSG = mysqli_error($conn);
                                                    }	
                                                }
                                                if (isset($_POST['Delete'])){ 
                                                    $dsql = 'DELETE FROM subject WHERE subjectID = "'.$id. '"'; 
                                                    if ($result = $conn->query($dsql)) {
                                                        $scMSG = "Deleted successfully";
                                                        echo "<script> alert('Course Deleted Successfully!'); location.href='SubjectView.php'; </script>";
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