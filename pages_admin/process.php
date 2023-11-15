<?php
require_once '../db_connect.php';


if (isset($_POST['depid'])) {
    $depid = $_POST['depid']; ?>
    <label>Course</label>
    <select class="form-control" name="course">
        <option value="">-- select staff course --</option>
        <?php
        $req = mysqli_query($conn, "SELECT * FROM subject WHERE subDepId='$depid'");
        while ($row = mysqli_fetch_array($req)) {
            echo '<option value="'.$row['id'].'">'.$row["subjectName"].'</option>';
        }
        ?>
    </select><?php
}

if (isset($_POST['search'])){
    $sessn = $_POST['sessn'];
    $semes = $_POST['semes'];
    $classes = $_POST['classes'];

    if (!empty($sessn) && !empty($semes) && !empty($classes)) {
        $que = mysqli_query($conn, "SELECT * FROM subject WHERE subjectType='$classes' AND semester='$semes'");
        $i=0;
        while ($row = mysqli_fetch_array($que)) {
            $i++;
            $req3 = mysqli_query($conn, "SELECT * FROM users WHERE courseid='".$row['id']."'");
            $rr3 = mysqli_fetch_array($req3);

            $req2 = mysqli_query($conn, "SELECT * FROM class WHERE id='$classes'");
            $rr2 = mysqli_fetch_array($req2);

            $frec = mysqli_query($conn, "SELECT * FROM records WHERE session = '$sessn' AND semester = '$semes' AND classid='$classes' AND courseid='".$row['id']."'");
            $drec = mysqli_fetch_array($frec);

            if (!empty($drec['id'])) {
                $req4 = mysqli_query($conn, "SELECT * FROM users WHERE id='".$drec['user']."'");
                $rr4 = mysqli_fetch_array($req4);
            }
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <?php if (empty($drec['id'])) { echo $rr3['fullname']; } else { echo $rr4['fullname']; }  ?>
                </td>
                <td><?php echo $row['subjectName']; ?></td>
                <td>
                    <?php echo $row['subjectID']; ?>
                </td>
                <td><?php echo $rr2['classname']; ?></td>
                <td><input type="checkbox" <?php if(!empty(@$drec['qpaper'])) { echo 'checked'; } ?> onclick="recMan('qpaper', '<?php echo @$drec['qpaper']; ?>', '<?php if (empty($drec['id'])) { echo $rr3['id']; } else { echo $rr4['id']; }  ?>', '<?php echo $classes; ?>', '<?php echo $row['id']; ?>', '<?php echo $sessn; ?>', '<?php echo $semes; ?>');"></td>

                <td><input type="checkbox" <?php if(!empty(@$drec['mans'])) { echo 'checked'; } ?> onclick="recMan('mans', '<?php echo @$drec['mans']; ?>', '<?php if (empty($drec['id'])) { echo $rr3['id']; } else { echo $rr4['id']; }  ?>', '<?php echo $classes; ?>', '<?php echo $row['id']; ?>', '<?php echo $sessn; ?>', '<?php echo $semes; ?>');"></td>

                <td><?php echo @$drec['sdate']; ?></td>

                <td><input type="checkbox" <?php if(!empty(@$drec['cdate'])) { echo 'checked'; } ?> onclick="recMan('cdate', '<?php echo @$drec['cdate']; ?>', '<?php if (empty($drec['id'])) { echo $rr3['id']; } else { echo $rr4['id']; }  ?>', '<?php echo $classes; ?>', '<?php echo $row['id']; ?>', '<?php echo $sessn; ?>', '<?php echo $semes; ?>');"></td>
            </tr>
            <?php
        }
    }
}

if (isset($_POST['procRecord'])) {
    $userRec = $_POST['userRec'];
    $classidRec = $_POST['classidRec'];
    $courseidRec = $_POST['courseidRec'];
    $sessionRec = $_POST['sessionRec'];
    $semesterRec = $_POST['semesterRec'];
    $rectype = $_POST['rectype'];
    $initval = $_POST['initval'];
    $date = date('Y-m-d');

    if (empty($initval)) {
        $initval = 'yes';
    } else {
        $initval = '';
    }

    if ($rectype == 'qpaper') {
        $quu = mysqli_query($conn, "SELECT * FROM records WHERE session='$sessionRec' AND semester='$semesterRec' AND classid='$classidRec' AND courseid='$courseidRec'");
        if (mysqli_num_rows($quu) == 0) {
            $qu = mysqli_query($conn, "INSERT INTO records VALUES ('', '$userRec', '$classidRec', '$courseidRec', '$initval', '', '$date', '', '$sessionRec', '$semesterRec')");
        } else {
            $qu = mysqli_query($conn, "UPDATE records SET qpaper='$initval' WHERE session='$sessionRec' AND semester='$semesterRec' AND classid='$classidRec' AND courseid='$courseidRec'");
        }
    } elseif ($rectype == 'mans') {
        $qu = mysqli_query($conn, "UPDATE records SET mans='$initval' WHERE session='$sessionRec' AND semester='$semesterRec' AND classid='$classidRec' AND courseid='$courseidRec'");
    } elseif ($rectype == 'cdate') {
        $qu = mysqli_query($conn, "UPDATE records SET cdate='$initval' WHERE session='$sessionRec' AND semester='$semesterRec' AND classid='$classidRec' AND courseid='$courseidRec'");
    }

    if ($qu) {
        echo 'Success';
    } else {
        echo 'Error occured!';
    }
}
?>