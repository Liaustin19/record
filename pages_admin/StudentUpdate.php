<!-- All the fields should be autopouplate including the checkboxes and select from database-->
<!DOCTYPE html>
<?php 
include("header.php");
require_once '../db_connect.php';
$id = $_GET["id"];

$namesql = 'SELECT * FROM users WHERE id="'.$id. '"'; 
$result = $conn->query($namesql); 
$row = $result->fetch_assoc();
?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Update staff Records</title>
        <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.addons.css">
        <link rel="stylesheet" href="/record/css/font_awesome/fontawesome-4.3.0.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
                                                <h2 style="float:left">Update staff - <?php echo $id; ?></h2>				
                                            </div>
                                            <form class="forms-sample" method="post">
                                                <div class="form-group">
                                                    <br/>
                                                    <label for="StaffFullname">Staff Full Name</label>
                                                    <input type="text" class="form-control" placeholder="" name="StaffFullname" id="StaffFullname" value="<?php echo $row['fullname']; ?>" required>
                                                </div>

                                                <div class="row">
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <br/>
                                                            <label for="uname">Staff Username</label>
                                                            <input type="text" class="form-control" placeholder="" name="uname" id="uname" value="<?php echo $row['Username']; ?>" required>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <br/>
                                                            <label for="pass">Staff Password</label>
                                                            <input type="password" class="form-control" placeholder="" name="pass" id="pass">
                                                        </div>
                                                    </div> -->

                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Role</label>
                                                            <select class="form-control" name="role" required>
                                                                <option value="">-- select staff role --</option>
                                                                <option value="HOD"<?php if ($row['Role'] == 'HOD') { echo 'selected'; } ?>>HOD</option>
                                                                <option value="Teacher"<?php if ($row['Role'] == 'Teacher') { echo 'selected'; } ?>>Teacher</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Department</label>
                                                            <select class="form-control" name="dep" required onchange="fetchCrs(this.value);">
                                                                <option value="">-- select staff department --</option>
                                                                <?php
                                                                $req = mysqli_query($conn, "SELECT * FROM dep");
                                                                while ($rr = mysqli_fetch_array($req)) {
                                                                    ?><option value="<?php echo $rr['id'] ?>" <?php if ($row['depid'] == $rr['id']) { echo 'selected'; } ?>><?php echo $rr["depname"] ?></option><?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div> -->

                                                    <div class="col-md-4">
                                                        <div class="form-group" id="allcrs">
                                                            <label>Course</label>
                                                            <select class="form-control" name="course">
                                                            <?php
                                                            $req = mysqli_query($conn, "SELECT * FROM subject");
                                                            while ($rr = mysqli_fetch_array($req)) {
                                                                ?><option value="<?php echo $rr['id'] ?>" <?php if ($row['courseid'] == $rr['id']) { echo 'selected'; } ?>><?php echo $rr["subjectName"] ?></option><?php
                                                            }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>											
                                                <button type="submit" class="btn btn-dark mr-2" name="update">Update</button>
                                                <button class="btn btn-light" name="Delete">Delete</button>	


                                                <?php 
                                                if (isset($_POST['update'])){ 
                                                    $StaffFullname=isset($_POST['StaffFullname'])?$_POST['StaffFullname']:null;
                                                    $course=isset($_POST['course'])?$_POST['course']:null;

                                                    $sql = 'UPDATE users SET
                                                        fullname = "'.$StaffFullname.'",
                                                        courseid = "'.$course.'"
                                                        WHERE id ="'.$id.'";';

                                                    if ($result = $conn->query($sql)) {
                                                        $scMSG = "Updated successfully";
                                                        echo "<script> alert('staff ".$StaffFullname." Record Updated Successfully!'); location.href='StudentView.php'; </script>";
                                                    } 
                                                    else {
                                                        $errMSG = mysqli_error($conn);
                                                    }
                                                }

                                                if (isset($_POST['Delete'])){
                                                    $namesql = 'SELECT * FROM users WHERE id="'.$id. '"'; 
                                                    $result = $conn->query($namesql); 
                                                    $row1 = $result->fetch_assoc();
                                                    $firstName = $row1['fullname'];

                                                    $dsql = 'DELETE FROM users WHERE id = "'.$id. '"'; 
                                                    if ($result = $conn->query($dsql)) {
                                                        $scMSG = "Deleted successfully";
                                                        echo "<script> alert('staff ".$firstName." Record Deleted Successfully!'); location.href='StudentView.php'; </script>";
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

        <!-- <script>
            function fetchCrs(depid) {
                $.ajax({
                    method: 'POST',
                    url: 'process.php',
                    data: {depid: depid},
                    success: function(res) {
                        $('#allcrs').html(res);
                    },
                    dataType: 'text'
                });
            }
        </script> -->
    </body>
</html>