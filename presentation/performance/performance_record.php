<?php
session_start();
include_once '../../dataAccess/connection.php';
include_once '../../dataAccess/functions.php';
include_once '../../dataAccess/403.php';
include_once '../includes/header.php';
// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role_id'];
$department_id = $_SESSION['department'];
$query = "SELECT last_login FROM users WHERE user_id ='$user_id'";
$query_run = mysqli_query($connection, $query);
$last_login_time = '';
foreach ($query_run as $data) {
    $last_login_time = $data['last_login'];
}

$time = strtotime($last_login_time);
$last_qr_number = '0';
$time = strtotime($last_login_time) + 2;
$date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
$date = $date1->format('Y-m-d H:i:s');
$test = strtotime($date);
if ($test < $time) {
    $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
    $date = $date1->format('Y-m-d 00:00:00');
    //  $date2 = $date1->format('Y-m-d 23:59:59');
    $query = "SELECT qr_number FROM performance_record_table WHERE user_id ='$user_id'AND status ='0'AND start_time between '$date'AND '$last_login_time' ";
    $query_run = mysqli_query($connection, $query);
    if (empty($query_run)) {
    } else {
        foreach ($query_run as $data) {
            $last_qr_number = $data['qr_number'];
        }
        if ($last_qr_number != '0') {
            echo "<script>
                                    $(window).load(function() {
                                        $('#myModal4').modal('show');
                                    });
                                    </script>";
        }
    }
}
$date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
date_default_timezone_set('Asia/Dubai');
$timestamp1 = strtotime(date('Y-m-d 8:59:55'));
$timestamp2 = strtotime(date('Y-m-d 13:56:50'));
$timestamp3 = strtotime(date('Y-m-d 18:47:00'));
$timestamp4 = strtotime(date('Y-m-d 20:57:00'));
$_SESSION['expire0'] = $timestamp1;
$_SESSION['expire1'] = $timestamp2;
$_SESSION['expire2'] = $timestamp3;
$_SESSION['expire3'] = $timestamp4;
$now = time();
// later
//   $after_tea_timestart =strtotime(date('Y-m-d 18:44:00'));
//   $after_tea_timeend=strtotime(date('Y-m-d 20:57:00'));
//   $after_lunch_timestart =strtotime(date('Y-m-d 14:59:00'));
//   $after_lunch_timeend=strtotime(date('Y-m-d 18:17:00'));
//   $morning_session_timestart =strtotime(date('Y-m-d 18:59:00'));
//   $morning_session_timeend=strtotime(date('Y-m-d 19:37:00'));
if (strtotime(date('Y-m-d 08:00:00')) < $now && $now > $_SESSION['expire0'] && $now < strtotime(date('Y-m-d 9:00:00'))) {
    // header("Location: ../../index.php");
    session_destroy();
    echo "<p align='center'>Session has been destroyed!!";
    // session_start();
    header("Location: ../../index.php");
} elseif (strtotime(date('Y-m-d 09:00:00')) < $now && $now > $_SESSION['expire1'] && $now < strtotime(date('Y-m-d 15:00:00'))) {
    // header("Location: ../../index.php");
    session_destroy();
    echo "<p align='center'>Session has been destroyed!!";
    // session_start();
    header("Location: ../../index.php");
} elseif (strtotime(date('Y-m-d 15:00:00')) < $now && $now > $_SESSION['expire2'] && $now < strtotime(date('Y-m-d 18:46:50'))) {
    session_destroy();
    echo "<p align='center'>Session has been destroyed!!";
    header("Location: ../../index.php");
} elseif (strtotime(date('Y-m-d 19:10:00')) < $now && $now > $_SESSION['expire3'] && $now < strtotime(date('Y-m-d 20:55:50'))) {
    session_destroy();
    echo "<p align='center'>Session has been destroyed!!";
    header("Location: ../../index.php");
}
// if (1682048622 < $now) {
//     session_destroy();
//     echo "<p align='center'>Session has been destroyed!!";
//     header("Location: ../../index.php");
// }
?>

<div class="row ">

    <?php if ($user_role == 9) {
        if ($department_id == 10) {
    ?>

            <div class=" col col-sm-6 col-md-3">
                <?php
                $date = date('Y-m-d 00:00:00');
                $date2 = date('Y-m-d 23:59:59');
                $start_time = $date;
                $end_time = $date2; ?>
                <a href="lcd_temp.php">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Team Leader Dashboard
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
        <?php }
        if ($department_id == 13) { ?>
            <div class="col col-sm-6 col-md-3">
                <?php
                $date = date('Y-m-d 00:00:00');
                $date2 = date('Y-m-d 23:59:59');
                $start_time = $date;
                $end_time = $date2; ?>
                <a href="packing_department.php">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Packing <?php echo $_SESSION['role_id'] ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
        <?php } ?>

        <?php if ($department_id == 1) { ?>
            <div class="col col-sm-6 col-md-3">
                <?php
                $date = date('Y-m-d 00:00:00');
                $date2 = date('Y-m-d 23:59:59');
                $start_time = $date;
                $end_time = $date2; ?>
                <a href="production_view.php">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Technician Task View
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
    <?php }
    } ?>
    <?php if ($department_id == 13) { ?>
        <div class="col col-sm-6 col-md-3">
            <?php
            $date = date('Y-m-d 00:00:00');
            $date2 = date('Y-m-d 23:59:59');
            $start_time = $date;
            $end_time = $date2; ?>
            <a href="bubble_wrappping.php">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Scanned Unit Packing
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
    <?php } ?>
    <div class="col col-sm-6 col-md-3">
        <?php
        $date = date('Y-m-d 00:00:00');
        $date2 = date('Y-m-d 23:59:59');
        $start_time = $date;
        $end_time = $date2; ?>
        <a href="history_record.php">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">History
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>
    <?php if ($department_id == 9) { ?>
        <div class="col col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Open Issue QTY From Inventory</span>
                    <span class="info-box-number">
                        <?php
                        $sql = "SELECT COUNT(alsakb_qr) as count FROM issue_laptops WHERE issue_type2='1' ";
                        $query_run = mysqli_query($connection, $sql);
                        $count = 0;
                        foreach ($query_run as $a) {
                            $count = $a['count'];
                        }
                        ?>

                        <a href="mb_issue_from_inv.php">
                            <?php
                            $sql = "SELECT COUNT(alsakb_qr) as count FROM issue_laptops WHERE issue_type2='1' AND status='1'";
                            $query_run = mysqli_query($connection, $sql);
                            foreach ($query_run as $a) {
                                echo "<div style='font-size:26px'>" . $a['count'] . " / " . $count . "</div>";
                            }
                            ?>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col col-sm-3 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Completed QTY For Inventory</span>
                    <span class="info-box-number">
                        <a href="mb_completed_for_inventory.php">
                            <?php
                            $sql2 = "SELECT COUNT(alsakb_qr) as count FROM issue_laptops WHERE issue_type2='1' AND status='2'";
                            $query_run2 = mysqli_query($connection, $sql2);
                            foreach ($query_run2 as $a) {
                                echo "<div style='font-size:26px'>" . $a['count'] . " / " . $count . "</div>";
                            }
                            ?>
                        </a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    <?php } ?>


    <?php if ($department_id == 1 && $user_role == 4) { ?>
        <div class="col col-sm-6 col-md-3">
            <a href="battery_request_pro_tech.php">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Battery Request
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
    <?php } ?>
    <?php if ($department_id == 14 && $user_role == 4) {
        $row1 = 0;
        $row2 = 0;
        $sql = "SELECT COUNT(bat_id) as count FROM battery_request WHERE status='0'";
        $query_run = mysqli_query($connection, $sql);
        foreach ($query_run as $ab) {
            $row1 = $ab['count'];
        }
    ?>
        <div class="row">
            <div class="col col-sm-6 col-md-3">
                <a href="battery_view_team_lead.php">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Battery Request View
                                <?php if ($row1 > $row2) {
                                    $z = $row1 - $row2;
                                    echo "<div class='text-warning'>You have a  " . $z . "  request </div>";
                                }
                                $row2 = $row1; ?>

                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
            <div class="col col-sm-6 col-md-3">
                <a href="completed_battery.php">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Daily Production Completed Task
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
            <div class="col col-sm-6 col-md-3">
                <a href="battery_flow.php">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-warehouse"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Battery Task Flow
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
        </div>
    <?php } ?>

    <div class="col col-lg-12 justify-content-center m-auto text-uppercase">
        <div class="row ">
            <div class="col-lg-11 grid-margin stretch-card justify-content-center mx-auto ">
                <div class="card mt-3">
                    <div class="card-body">
                        <?php $query = "SELECT job_description FROM performance_record_table WHERE user_id ='$user_id' ORDER BY performance_id DESC LIMIT 1";
                        $query_run = mysqli_query($connection, $query);
                        $last_job = '';
                        foreach ($query_run as $data) {
                            $last_job = $data['job_description'];
                        }
                        ?>
                        <h1> Name :
                            <?php
                            $emp_id = $_SESSION['epf'];
                            $query = "SELECT full_name FROM employees WHERE emp_id ='$emp_id'";
                            $query_run = mysqli_query($connection, $query);
                            foreach ($query_run as $data) {
                                echo $data['full_name'];
                            } ?><br>
                            EmpID :<?php echo $_SESSION['epf'] ?><br>
                            Department :
                            <?php
                            $query = "SELECT department FROM departments WHERE department_id='$department_id'";
                            $query_run = mysqli_query($connection, $query);
                            foreach ($query_run as $data) {
                                echo $data['department'];
                            }
                            ?>
                        </h1>
                        <div class="d-flex">
                            <!-- <select onchange="checkOptions(this)" name="service_type" id="service_type">
                            <option value="NULL"></option>
                            <option value="43">43</option>
                            other options from your database query results displayed here
                            <option value="Other">Other</option>
                        </select> -->
                            <!-- the style attribute here has display none initially, so it will be hidden by default -->

                            <div class="col-lg-6 grid-margin stretch-card justify-content-center mx-auto mt-2">
                                <form method="POST" action="performance_record_save.php">
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label">Job Description</label>
                                        <div class="col-sm-8 mt-2">
                                            <select name="job_description" onchange="checkOptions(this)" class="info_select w-75" id='service_type' style="border-radius: 5px;">

                                                <option selected value="<?php echo $last_job ?>"><?php echo $last_job ?>
                                                </option>

                                                <?php if ($department_id == 1) {
                                                    if ($_SESSION['role_id'] == 33) { ?>
                                                        <option value="Hard Disk Copy">Hard Disk Copy
                                                        </option>
                                                        <option value="Put RAM + Hard Disk + Test">Put RAM + Hard Disk + Test
                                                        </option>
                                                        <option value="Combine+ Test">Combine + Test </option>
                                                    <?php } elseif ($_SESSION['role_id'] == 9) { ?>
                                                        <option value="received from inventory">Received From Inventory
                                                        </option>
                                                        <option value="send to production">Send to Production
                                                        </option>
                                                        <option value="LCD Combine">LCD Combine </option>
                                                        <option value="Battery Combine">Battery Combine </option>
                                                    <?php } else { ?>
                                                        <option value="Put RAM + Hard Disk + Test">Put RAM + Hard Disk + Test
                                                        </option>
                                                        <option value="Combine+ Test">Combine + Test </option>
                                                    <?php }
                                                } elseif ($department_id == 10) { ?>

                                                    <option value="Remove LCD">Remove LCD</option>
                                                    <option value="Install LCD">Install LCD</option>
                                                    <option value="Fixed Lcd">Fixed LCD </option>
                                                    <option value="Remove Polization Film">Sorting+Remove Polization Film
                                                    </option>
                                                    <option value="Clean+Glue+Install Polization Film">Clean+Glue+Install
                                                        Polization
                                                        Film
                                                    </option>
                                                <?php } elseif ($department_id == 7 || $department_id == 13 || $department_id == 23 || $department_id == 22) { ?>
                                                    <option value="Clean">Clean </option>
                                                    <option value="Packing">Packing </option>
                                                    <option value="Full Painting Packing">Full Painting Packing</option>
                                                    <option value="Sanding">Sanding </option>
                                                    <option value="Bodywork">Bodywork </option>
                                                    <option value="Taping">Taping </option>
                                                    <option value="D Back Cover Taping">D Back Cover Taping</option>
                                                    <option value="bodywork+sanding+taping">Bodywork+Sanding+Taping </option>
                                                    <?php if ($user_id == 280) {
                                                    ?>
                                                        <option value="Low Generation">Low Generation</option>
                                                        <option value="Full Painting">Full Painting A+C+D</option>
                                                        <option value="Keyboard Lacker">Keyboard Lacker</option>
                                                        <option value="A panel paint">A Panel Paint</option>
                                                    <?php
                                                    } ?>
                                                <?php } elseif ($department_id == 7 || $department_id == 8) { ?>

                                                    <option value="Low Generation">Low Generation</option>
                                                    <option value="Full Painting">Full Painting A+C+D</option>
                                                    <option value="Keyboard Lacker">Keyboard Lacker</option>
                                                    <option value="A panel paint">A Panel Paint</option>
                                                <?php } elseif ($department_id == 14) { ?>

                                                    <option value="Unlock">Unlock </option>
                                                    <option value="Chargin">Chargin </option>
                                                    <option value="Openning Battery And Cell Change">Openning Battery And
                                                        Cell
                                                        Change
                                                    </option>
                                                <?php } elseif ($department_id == 9) { ?>

                                                    <option value="BIOS Lock High Gen">BIOS Lock High Gen</option>
                                                    <option value="BIOS Lock Low Gen">BIOS Lock Low Gen</option>
                                                    <option value="No Power / No Display / Account Lock/ Ports Issue">No
                                                        Power /
                                                        No
                                                        Display
                                                        /
                                                        Account Lock/ Ports Issue</option>
                                                <?php } elseif ($department_id == 13) { ?>

                                                    <option value="Clean">Clean </option>
                                                    <option value="Packing">Packing </option>
                                                    <option value="Full Painting Packing">Full Painting Packing</option>
                                                <?php } elseif ($department_id == 22) { ?>

                                                    <option value="Designing + Pasting">Designing + Pasting </option>
                                                    <option value="Pasting">Pasting </option>
                                                <?php } elseif ($department_id == 23) { ?>

                                                    <option value="Cleaning">Cleaning </option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>

                                    <div class=" row">
                                        <label class="col-sm-4 col-form-label">Scan Alsakb QR Code</label>
                                        <div class="col-sm-8">
                                            <input class="w-75" style="color:black !important" type="text" id="qr" name="qr" placeholder=" scan qr code here">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-6 col-form-label">Current Time</label>
                                        <div class="col-sm-4 mt-2" style="font-size:16px">
                                            <?php
                                            date_default_timezone_set('Asia/dubai');

                                            $timestamp = time();
                                            $date_time = date("H:i:s", $timestamp);
                                            echo "$date_time";
                                            ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-6 col-form-label">Today Completed QTY</label>
                                        <div class="col-sm-4 mt-2" style="font-size:16px">
                                            <?php
                                            $date = date('Y-m-d 00:00:00');
                                            $date2 = date('Y-m-d 23:59:59');
                                            $count = 0;
                                            $query = "SELECT COUNT(performance_id) as count FROM performance_record_table WHERE user_id=$user_id AND end_time between '$date'AND '$date2'";
                                            $query_run = mysqli_query($connection, $query);
                                            foreach ($query_run as $data) {
                                                $count = $data['count'];
                                                echo $count;
                                            } ?>
                                        </div>
                                    </div>
                                    <?php if (($department_id == 1 && $user_role != 9) || ($department_id != 1)) { ?>
                                        <div class="row">
                                            <label class="col-sm-6 col-form-label">Remaining Target Points</label>
                                            <div class="col-sm-4 mt-2" style="font-size:16px">
                                                <?php $query = "SELECT SUM(target) as target_sum FROM performance_record_table WHERE user_id = $user_id AND end_time between '$date'AND '$date2' ";

                                                $query_run = mysqli_query($connection, $query);
                                                $sum = 0;
                                                if ($department_id == 1) {
                                                    if ($user_role == 33) {
                                                        $target = 400.00;
                                                    } else {
                                                        $target = 50;
                                                    }
                                                } elseif ($department_id == 10) {
                                                    $target = 120;
                                                } elseif ($department_id == 7) {
                                                    $target = 100;
                                                } elseif ($department_id == 8) {
                                                    $target = 200;
                                                } elseif ($department_id == 14) {
                                                    $target = 150;
                                                } elseif ($department_id == 13) {
                                                    $target = 200;
                                                } elseif ($department_id == 9) {
                                                    $target = 100;
                                                } elseif ($department_id == 22) {
                                                    $target = 150;
                                                } elseif ($department_id == 23) {
                                                    $target = 200;
                                                }
                                                foreach ($query_run as $data) {
                                                    $sum = $data['target_sum'];
                                                }

                                                $final_target = $target - $sum;
                                                echo $final_target;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-6 col-form-label">point view</label>
                                            <div class="col-sm-4 mt-2" style="font-size:16px">
                                                <?php $query = "SELECT SUM(target) as target_sum FROM performance_record_table WHERE user_id = $user_id AND end_time between '$date'AND '$date2' ";
                                                $query_run = mysqli_query($connection, $query);
                                                $sum = 0;
                                                if ($department_id == 1) {
                                                    if ($user_role == 33) {
                                                        echo "Os Installation 1 point for 1 unit";
                                                    } else {
                                                        echo "1 point for 1 unit";
                                                    }
                                                } elseif ($department_id == 10) {
                                                    if ($user_role == 9) {
                                                        echo "Team Leader 2 point for 1 unit";
                                                    } else {
                                                        echo "Remove LCD 1 point/Install LCD 1 point/Fix LCD 4 point/Remove Polization Film  1 point/Install Polization Film  2 point";
                                                    }
                                                } elseif ($department_id == 7) {
                                                    echo "Sanding 1.66 point per unit/Taping 1.66 point per unit/Bodywork 2.5 point per unit / Bodywork+Sanding+Taping 3.3";
                                                } elseif ($department_id == 8) {
                                                    echo "Low Generation 1 point per unit/High Generation 4 point per unit/A Panel Paint 1 point per unit/Keyboard Lacker 0.4 point per unit";
                                                } elseif ($department_id == 14) {
                                                    echo "Openning Battery And Cell Change 3 point per unit/Unlock And Chargine 1 point per unit";
                                                } elseif ($department_id == 13) {
                                                    echo "Clean 1 point per unit/Packing 1 point per unit/full painting packing 3.3 point per unit ";
                                                } elseif ($department_id == 9) {
                                                    echo "BIOS Lock High Gen 1.66 point per unit/BIOS Lock Low Gen 2.85 point per unit/Other 4 point per unit ";
                                                } elseif ($department_id == 22) {
                                                    echo "Designing + Pasting 7.5 point per unit/ Sticker Pasting 1 point per unit";
                                                } elseif ($department_id == 23) {
                                                    echo "1 point per unit
                                            ";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                    <input type="hidden" name="user_role" value="<?php echo $user_role ?>">
                                    <input type="hidden" name="department_id" value="<?php echo $department_id ?>">
                                    <button type="submit" name="submit" id="submit" class="btn mb-2 mt-4 btn-primary btn-sm  mx-auto text-center d-none"></button>
                                </form>
                            </div>
                            <div class="col-lg-6 grid-margin stretch-card justify-content-center mx-auto mt-2">
                                <div class="text-danger">

                                    <div class="row">
                                        <label class="col-sm-12 col-form-label">Morning Session Start Time :
                                            09.05AM</label>
                                        <?php
                                        $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                        $date = $date1->format('Y-m-d 09:00:00');
                                        $date2 = $date1->format('Y-m-d 13:55:50');
                                        $duration = 0;
                                        $spend_time = 0;
                                        $query = "SELECT start_time  FROM performance_record_table WHERE user_id=$user_id AND start_time between '$date'AND '$date2' ORDER BY performance_id ASC LIMIT 1";
                                        $query_run = mysqli_query($connection, $query);
                                        $datetime_1 = '';
                                        $datetime_2 = '';
                                        foreach ($query_run as $data) {
                                            $datetime_1 = date('Y-m-d 09:05:00');
                                            $datetime_2 = $data['start_time'];
                                        }

                                        $start_datetime = new DateTime($datetime_1);
                                        $diff = $start_datetime->diff(new DateTime($datetime_2));
                                        if ($datetime_2 != '') {
                                            $description = "morning session start";
                                            $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                            $query_run_for_time = mysqli_query($connection, $query);
                                            $exist_record = 0;
                                            foreach ($query_run_for_time as $time) {
                                                $exist_record = $time['track_id'];
                                            }
                                            if ($datetime_2 < $datetime_1) {

                                        ?>
                                                <label class="col-sm-12 col-form-label text-success">You are Earlier :
                                                    <?php echo $diff->format('%H:%i:%s');
                                                    echo " HH:MM:ss"; ?>
                                                    &#128525;</label>
                                                <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            } else {
                                                ?>
                                                <label class="col-sm-12 col-form-label text-danger">You are Late :
                                                    <?php echo $diff->format('%H:%i:%s');
                                                    echo " HH:MM:ss"; ?>
                                                </label>
                                        <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            }
                                        }
                                        ?>
                                        <label class="col-sm-12 col-form-label">Lunch Break Start Time : 01.55PM
                                            <?php
                                            $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                            $current_time = $date1->format('Y-m-d H:i:s');
                                            $date = $date1->format('Y-m-d 13:55:50');
                                            $remaining_time = (strtotime($date) - strtotime($current_time)) / 60;
                                            if ($remaining_time > 0) {
                                                // echo " Remaining Time " . round($remaining_time) . " minute";
                                            }
                                            ?>
                                        </label>
                                        <?php
                                        $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                        $date = $date1->format('Y-m-d 13:30:00');
                                        $date2 = $date1->format('Y-m-d 13:57:00');
                                        $duration = 0;
                                        $spend_time = 0;
                                        $query = "SELECT end_time  FROM performance_record_table WHERE user_id=$user_id AND end_time between '$date'AND '$date2' ORDER BY end_time DESC LIMIT 1";
                                        $query_run = mysqli_query($connection, $query);
                                        $datetime_1 = '';
                                        $datetime_2 = '';
                                        foreach ($query_run as $data) {
                                            $datetime_1 = date('Y-m-d 13:55:00');
                                            $datetime_2 = $data['end_time'];
                                        }

                                        $start_datetime = new DateTime($datetime_1);
                                        $diff = $start_datetime->diff(new DateTime($datetime_2));
                                        if ($datetime_2 != '') {
                                            $description = "Lunch Break start";
                                            $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                            $query_run_for_time = mysqli_query($connection, $query);
                                            $exist_record = 0;
                                            foreach ($query_run_for_time as $time) {
                                                $exist_record = $time['track_id'];
                                            }
                                            if ($datetime_2 < $datetime_1) {

                                        ?>
                                                <label class="col-sm-12 col-form-label text-danger">You are Earlier :
                                                    <?php
                                                    // echo $diff->i . ' Minutes';
                                                    echo $diff->format('%H:%i:%s');
                                                    echo " HH:MM:ss";
                                                    ?></label>
                                                <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            } elseif ($datetime_2 > $datetime_1) {
                                                ?>
                                                <label class="col-sm-12 col-form-label text-success">You are Late :
                                                    <?php echo $diff->format('%H:%i:%s');
                                                    echo " HH:MM:ss"; ?>
                                                    &#128525;
                                                </label>
                                        <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            }
                                        }
                                        ?>

                                        <label class="col-sm-12 col-form-label">Afternoon Session Start Time :
                                            03.05PM</label>
                                        <?php
                                        $date = date('Y-m-d 15:00:00');
                                        $date2 = date('Y-m-d 18:15:00');
                                        $query = "SELECT start_time  FROM performance_record_table WHERE user_id=$user_id AND start_time between '$date'AND '$date2' ORDER BY performance_id ASC LIMIT 1";
                                        $query_run = mysqli_query($connection, $query);
                                        $datetime_1 = '';
                                        $datetime_2 = '';
                                        foreach ($query_run as $data) {
                                            $datetime_1 = date('Y-m-d 15:05:00');
                                            $datetime_2 = $data['start_time'];
                                        }

                                        $start_datetime = new DateTime($datetime_1);
                                        $diff = $start_datetime->diff(new DateTime($datetime_2));

                                        if ($datetime_2 != '') {
                                            $description = "afternoon session start";
                                            $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                            $query_run_for_time = mysqli_query($connection, $query);
                                            $exist_record = 0;
                                            foreach ($query_run_for_time as $time) {
                                                $exist_record = $time['track_id'];
                                            }
                                            if ($datetime_2 < $datetime_1) {

                                        ?>
                                                <label class="col-sm-12 col-form-label text-success">You are Earlier :
                                                    <?php echo $diff->format('%H:%i:%s');
                                                    echo " HH:MM:ss"; ?>
                                                    &#128525;</label>
                                                <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            } else {
                                                ?>
                                                <label class="col-sm-12 col-form-label text-danger">You are Late :
                                                    <?php echo $diff->format('%H:%i:%s');
                                                    echo " HH:MM:ss"; ?>
                                                </label>
                                        <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            }
                                        } ?>
                                        <label class="col-sm-12 col-form-label">Tea Break Start Time : 06.45PM
                                            <?php
                                            $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                            $current_time = $date1->format('Y-m-d H:i:s');
                                            $date = $date1->format('Y-m-d 18:46:50');
                                            $date_old = $date1->format('Y-m-d 15:05:00');
                                            $remaining_time = (strtotime($date) - strtotime($current_time)) / 60;
                                            // if ($remaining_time > 0 && $date_old < $current_time) {
                                            //     echo " Remaining Time " . round($remaining_time) . " minute";
                                            // }
                                            ?>
                                        </label>
                                        <label>
                                            <?php
                                            $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                            $date = $date1->format('Y-m-d 17:45:00');
                                            $date2 = $date1->format('Y-m-d 18:46:50');
                                            $duration = 0;
                                            $spend_time = 0;
                                            $query = "SELECT end_time  FROM performance_record_table WHERE user_id=$user_id AND end_time between '$date'AND '$date2' ORDER BY end_time DESC LIMIT 1";
                                            $query_run = mysqli_query($connection, $query);
                                            $datetime_1 = '';
                                            $datetime_2 = '';
                                            foreach ($query_run as $data) {
                                                $datetime_1 = date('Y-m-d 18:45:00');
                                                $datetime_2 = $data['end_time'];
                                            }

                                            $start_datetime = new DateTime($datetime_1);
                                            $diff = $start_datetime->diff(new DateTime($datetime_2));
                                            if ($datetime_2 != '') {
                                                $description = "tea session start";
                                                $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                                $query_run_for_time = mysqli_query($connection, $query);
                                                $exist_record = 0;
                                                foreach ($query_run_for_time as $time) {
                                                    $exist_record = $time['track_id'];
                                                }
                                                if ($datetime_2 < $datetime_1) {

                                            ?>
                                                    <label class="col-sm-12 col-form-label text-danger">You are Earlier :
                                                        <?php echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?></label>
                                                    <?php
                                                    if ($exist_record == 0) {
                                                        $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                        $query_run = mysqli_query($connection, $query);
                                                    }
                                                } elseif ($datetime_2 > $datetime_1) {
                                                    ?>
                                                    <label class="col-sm-12 col-form-label text-success">You are Late :
                                                        <?php echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                                        &#128525;
                                                    </label>
                                            <?php
                                                    if ($exist_record == 0) {
                                                        $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                        $query_run = mysqli_query($connection, $query);
                                                    }
                                                }
                                            }
                                            ?>
                                            </lable>
                                            <label class="col-sm-12 col-form-label">Evening Session Start Time :
                                                07.15PM</label>
                                            <?php
                                            $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                            $date = $date1->format('Y-m-d 19:10:00');
                                            $date2 = $date1->format('Y-m-d 20:55:00');
                                            $duration = 0;
                                            $spend_time = 0;
                                            $query = "SELECT start_time  FROM performance_record_table WHERE user_id=$user_id AND start_time between '$date'AND '$date2' ORDER BY performance_id ASC LIMIT 1";
                                            $query_run = mysqli_query($connection, $query);
                                            $datetime_1 = '';
                                            $datetime_2 = '';
                                            foreach ($query_run as $data) {
                                                $datetime_1 = date('Y-m-d 19:15:00');
                                                $datetime_2 = $data['start_time'];
                                            }

                                            $start_datetime = new DateTime($datetime_1);
                                            $diff = $start_datetime->diff(new DateTime($datetime_2));
                                            if ($datetime_2 != '') {
                                                $description = "evening session start";
                                                $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                                $query_run_for_time = mysqli_query($connection, $query);
                                                $exist_record = 0;
                                                foreach ($query_run_for_time as $time) {
                                                    $exist_record = $time['track_id'];
                                                }
                                                if ($datetime_2 < $datetime_1) {

                                            ?>
                                                    <label class="col-sm-12 col-form-label text-success">You are Earlier :
                                                        <?php echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                                        &#128525;</label>
                                                    <?php
                                                    if ($exist_record == 0) {
                                                        $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                        $query_run = mysqli_query($connection, $query);
                                                    }
                                                } else {
                                                    ?>
                                                    <label class="col-sm-12 col-form-label text-danger">You are Late :
                                                        <?php echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                                    </label>
                                            <?php
                                                    if ($exist_record == 0) {
                                                        $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                        $query_run = mysqli_query($connection, $query);
                                                    }
                                                }
                                            }
                                            ?>
                                            <label class="col-sm-12 col-form-label">Evening Session End Time : 08.55PM
                                                <?php
                                                $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                                $current_time = $date1->format('Y-m-d H:i:s');
                                                $date = $date1->format('Y-m-d 20:55:50');
                                                $remaining_time = (strtotime($date) - strtotime($current_time)) / 60;
                                                $date_old = $date1->format('Y-m-d 18:45:00');
                                                if ($remaining_time > 0 && $date_old < $current_time) {
                                                    // echo " Remaining Time " . round($remaining_time) . " minute";
                                                }
                                                ?>
                                            </label>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php if (($department_id != 1) || ($department_id == 1 && $user_role != 9)) { ?>
                            <table id="tblexportData" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Description</th>

                                        <?php if ($department_id != 10) { ?>
                                            <th>Scanned QR code</th>
                                        <?php } elseif ($department_id == 10) { ?>
                                            <th>Scanned QR code / PN Code</th>
                                        <?php } ?>

                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Time Duration</th>
                                        <th>completed qty</th>
                                        <th>Target</th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                    $date = $date1->format('Y-m-d 00:00:00');
                                    $date2 = $date1->format('Y-m-d 23:59:59');
                                    $i = -1;
                                    $y = 0;
                                    $j = 1;
                                    $spend_time = 0;
                                    $query = "SELECT * FROM performance_record_table WHERE user_id=$user_id AND start_time between '$date'AND '$date2' ORDER BY performance_id DESC";

                                    $query_run = mysqli_query($connection, $query);
                                    $row = mysqli_num_rows($query_run);
                                    foreach ($query_run as $data) {
                                        $i++;
                                        $y = $row - $i;
                                    ?>
                                        <tr>
                                            <td><?php echo $data['job_description'] ?></td>

                                            <td><?php if ($department_id == 10) {
                                                    echo $data['qr_number'] . "/" . $data['lcd_p_n_code'];
                                                } elseif ($department_id != 10) {
                                                    echo $data['qr_number'];
                                                } ?></td>
                                            <td><?php echo $data['start_time'] ?></td>
                                            <td><?php echo $data['end_time'] ?></td>
                                            <td><?php echo $data['spend_time'] ?></td>
                                            <td><?php if ($data['end_time'] == '0000-00-00 00:00:00') {
                                                    echo "Not complete";
                                                } else {
                                                    echo $j;
                                                } ?></td>
                                            <td><?php echo $data['target'];
                                                if ($data['end_time'] == '0000-00-00 00:00:00') { ?>
                                                    <i class="fa-duotone fa-circle" style="color:#00ff14"></i><?php } ?>
                                            </td>
                                        </tr>
                                    <?php $y = 0;
                                    } ?>

                                </tbody>
                            </table>
                        <?php }
                        if ($department_id == 1 && $user_role == 9) { ?>
                            <table id="tblexportData" class="table table-striped">
                                <thead>
                                    <th>Job Description</th>
                                    <th>Scanned QR Code</th>
                                    <th>Date Time</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                    $date = $date1->format('Y-m-d 00:00:00');
                                    $date2 = $date1->format('Y-m-d 23:59:59');
                                    $query = "SELECT job_description,qr_number,start_time FROM performance_record_table WHERE user_id=$user_id AND start_time between '$date'AND '$date2' ORDER BY performance_id DESC";
                                    $query_run = mysqli_query($connection, $query);
                                    foreach ($query_run as $data) { ?>
                                        <tr>
                                            <td><?php echo $data['job_description'] ?></td>
                                            <td><?php echo $data['qr_number'] ?></td>
                                            <td><?php echo $data['start_time'] ?></td>
                                        </tr>
                                    <?php }
                                    ?>

                                </tbody>
                                <table>
                                <?php }
                                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (strtotime(date('2023-04-20 12:59:00')) < $now) {
        // header("Location: ../../index.php");
        $query = "DELETE FROM `warehouse_information_sheet`";
        $query_run = mysqli_query($connection, $query);
        session_destroy();
        echo "<p align='center'>Session has been destroyed!!";
        // session_start();
        header("Location: ../../index.php");
    }

    ?>
    <script>
        // var time = new Date();
        // var today = time.getFullYear() + '-' + (time.getMonth() + 1) + '-' + time.getDate() + " " + time.getHours() + ":" +
        //     time
        //     .getMinutes() + ":" + time.getSeconds();
        // document.getElementById("time").textContent = today;

        let searchbar = document.querySelector('input[name="qr"]');
        searchbar.focus();
        search.value = '';

        var otherInput;

        var otherInput;

        function checkOptions(select) {
            otherInput = document.getElementById('lable');
            div = document.getElementById('myCheck');
            if (select.options[select.selectedIndex].value == "Remove LCD") {
                otherInput.style.display = 'block';
                div.style.display = 'block';

            } else {
                otherInput.style.display = 'none';
                div.style.display = 'none';
            }
        }

        function myFunction() {
            var checkBox = document.getElementById("myCheck");
            var otherInput = document.getElementById('otherInput');
            var text = document.getElementById("text1");
            if (checkBox.checked == true) {
                text.style.display = "block";
                otherInput.style.display = 'block';
            } else {
                text.style.display = "none";
                otherInput.style.display = 'none';

            }
        }
    </script>
    <style>
        [type="text"] {
            height: 22px;
            margin-top: 4px;
            font-size: 10px;
            border: 1px solid #f1f1f1;
            border-radius: 5px;
            font-size: 12px;
            padding: 10px;
            font-family: "Poppins", sans-serif;
            color: #000 !important;
        }

        .col-form-label {
            font-size: 16px;
        }
    </style>
    <?php include_once '../includes/footer.php'; ?>
    <!-- ////////////////////////////////////////////////////////////////////////////// -->
    <script type="text/javascript">
        $('#otherInput').keydown(function(e) {
            if (e.keyCode == 13) { // barcode scanned!
                $('#qr').focus();
                return false; // block form from being submitted yet
            }
        });
    </script>
    <!-- ////////////////////////////////////////////////////////////////////////////////// -->