<!DOCTYPE html>
<?php 
include("header.php");
require_once '../db_connect.php';
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Add Staff</title>
        <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="/record/css/font_awesome/fontawesome-4.3.0.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.addons.css">
        <link rel="stylesheet" href="../vendors/icheck/skins/all.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" href="../images/favicon.png" />
        <?php
        if(isset($_POST['insert'])){
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            else{
                $StaffFullname=isset($_POST['StaffFullname'])?$_POST['StaffFullname']:null;
                // $uname=isset($_POST['uname'])?$_POST['uname']:null;
                // $pass=isset($_POST['pass'])?password_hash($_POST['pass'], PASSWORD_DEFAULT):null;
                // $role=isset($_POST['role'])?$_POST['role']:null;
                // $dep=isset($_POST['dep'])?$_POST['dep']:null;
                $course=isset($_POST['course'])?$_POST['course']:null;

                $stmt = $conn->query("SELECT * FROM users WHERE StaffFullname='$StaffFullname'");
                $count = $stmt->num_rows;
                if ($count==0) {
                    $sql = "INSERT INTO users SET fullname='$StaffFullname', courseid='$course'";

                    if (mysqli_query($conn, $sql)) {
                        //                        echo $bname." added to table successfully";
                        echo "<script> alert('".$StaffFullname." Staff Added Successfully!'); location.href='StudentView.php'; </script>";
                    } 
                    else {
                        echo "Error: ". mysqli_error($conn);
                    }
                }
                else 
                {
                    echo "Username already exists"; 
                }
            }
        }
        if(isset($_POST['cancel'])){
            header('Location:StudentView.php');				
        }
        // mysqli_close($conn);
        ?>
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
                                                <h2 style="float:left">Add Staff</h2>				
                                            </div>
                                            <form class="forms-sample" method="post">
                                                <div class="form-group">
                                                    <br/>
                                                    <label for="StaffFullname">Staff Full Name</label>
                                                    <input type="text" class="form-control" placeholder="" name="StaffFullname" id="StaffFullname" required>
                                                </div>

                                                <div class="row">
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <br/>
                                                            <label for="uname">Staff Username</label>
                                                            <input type="text" class="form-control" placeholder="" name="uname" id="uname" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <br/>
                                                            <label for="pass">Staff Password</label>
                                                            <input type="password" class="form-control" placeholder="" name="pass" id="pass" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Role</label>
                                                            <select class="form-control" name="role" required>
                                                                <option value="">-- select staff role --</option>
                                                                <option value="HOD">HOD</option>
                                                                <option value="Teacher">Teacher</option>
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
                                                                while ($row = mysqli_fetch_array($req)) {
                                                                    echo '<option value="'.$row['id'].'">'.$row["depname"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div> -->

                                                    <div class="col-md-4">
                                                        <div class="form-group" id="allcrs">
                                                            <label>Course</label>
                                                            <select class="form-control" name="course">
                                                                <option value="">-- select staff course --</option>
                                                                <?php
                                                                    $req = mysqli_query($conn, "SELECT * FROM subject");
                                                                    while ($rr = mysqli_fetch_array($req)) {
                                                                        ?><option value="<?php echo $rr['id'] ?>"><?php echo $rr["subjectName"] ?></option><?php
                                                                    }
                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-dark mr-2" name="insert">Submit</button>
                                                <input type="button" class="btn btn-light" name="cancel" value="Cancel" onclick="window.location.href='StudentView.php'"/>
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
        </div>
    <script src="../vendors/js/vendor.bundle.base.js"></script>
    <script src="../vendors/js/vendor.bundle.addons.js"></script>
    <script src="../js/off-canvas.js"></script>
    <script src="../js/misc.js"></script>
    <!-- <script src="../js/jquery.js"></script> -->

    <script>
        // function fetchCrs(depid) {
        //     $.ajax({
        //         method: 'POST',
        //         url: 'process.php',
        //         data: {depid: depid},
        //         success: function(res) {
        //             $('#allcrs').html(res);
        //         },
        //         dataType: 'text'
        //     });
        // }


        // $.ajax({
        //     method: 'POST',
        //     url: 'process.php',
        //     data: new FormData(this),
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     success: function(res) {
        //         // $('#upldThmsFrm')[0].reset();
        //         alert('yesssss');
        //     },
        //     dataType: 'text'
        // });
    </script>
    </body>
</html>