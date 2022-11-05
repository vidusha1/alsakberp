<?php
ob_start(); 
session_start();
include_once('../../dataAccess/connection.php');
include_once('../../dataAccess/functions.php');
include_once('../../dataAccess/403.php');
include_once('../includes/header.php');

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}
$created_date = $_GET['date'];
$day = $_GET['day'];
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center"><a href="#">
            <i class="fa-regular fa-circle-left fa-2x m-2" style="color: #ced4da;"></i>
        </a>
    </div>
</div>
<?php 
            $query1 = "SELECT DISTINCT emp_id FROM `requested_part_from_production`WHERE created_date = '$created_date'  ;";
            $query_run1 = mysqli_query($connection, $query1);
            foreach($query_run1 as $a){
                $query2 = "SELECT  location FROM `users` WHERE epf = '{$a['emp_id']}';";
            $query_run2 = mysqli_query($connection, $query2);
            $emp_location ='';
            foreach($query_run2 as $b){
                $emp_location = $b['location'];
            }
            ?>
<!-- Info boxes -->
<div class="row mt-4 m-2">
    <div class="col-12 col-sm-6 col-md-4">

        <div class="info-box">
            <div class="info-box-content">
                <span class="info-box-text">
                    <h3><?php echo  $emp_location."-".$day; ?></h3>
                </span>
                <?php
                $date=date_create($created_date);
                date_sub($date,date_interval_create_from_date_string("7 days"));
                $past_7_days= date_format($date,"Y-m-d");
                $date1=date_create($created_date);
                date_sub($date1,date_interval_create_from_date_string("14 days"));
                $past_14_days= date_format($date1,"Y-m-d");

                $query = "SELECT emp_id,model,created_date, COUNT(model) AS request FROM `requested_part_from_production`WHERE (created_date = '$created_date') AND status =1 GROUP BY model;";
                
                $query_run = mysqli_query($connection, $query);
                foreach($query_run as $b){
                $query1 = "SELECT emp_id,model,created_date, COUNT(model) AS request FROM `requested_part_from_production`WHERE (created_date = '$past_7_days') AND status =1 GROUP BY model;";              
                $query_run1 = mysqli_query($connection, $query1);
                $query2 = "SELECT emp_id,model,created_date, COUNT(model) AS request FROM `requested_part_from_production`WHERE (created_date = '$past_14_days') AND status =1 GROUP BY model;";              
                $query_run2 = mysqli_query($connection, $query2);
                ?>
                <a
                    href="part_warehouse_task_view.php?model=<?php echo $b['model']  ?>&emp_id=<?php echo $b['emp_id']  ?>&date=<?php echo $created_date ?>">
                    <span class="info-box-number text-white">
                        <?php
                        echo "Model : ".$b['model']." /";
                        echo " Count :".$b['request'];
                        }
                    ?>
                        <?php
                foreach($query_run1 as $c){
                    ?>
                        <a
                            href="part_warehouse_task_view.php?model=<?php echo $c['model']  ?>&emp_id=<?php echo $c['emp_id']  ?>&date=<?php echo $past_7_days ?>">
                            <span class="info-box-number text-warning">
                                <?php
                        echo "Model : ".$c['model']." /";
                        echo " Count :".$c['request'];
                        }
                    ?>

                                <?php
                foreach($query_run2 as $d){
                    ?>
                                <a
                                    href="part_warehouse_task_view.php?model=<?php echo $d['model']  ?>&emp_id=<?php echo $d['emp_id']  ?>&date=<?php echo $past_14_days ?>">
                                    <span class="info-box-number text-danger">
                                        <?php
                        echo "Model : ".$d['model']." /";
                        echo " Count :".$d['request'];
                        }
                ?>
                                    </span>
                                    <?php  ?>
            </div>
            <!-- /.info-box-content -->
        </div>
        </a>
        <!-- /.info-box -->
    </div>

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>


</div>
<!-- /.row -->
<?php } ?>

<style>
fieldset,
legend {
    all: revert;
    font-size: 12px;
}

textarea {
    text-transform: uppercase;
}

select,
[type="number"] {
    width: 100%;
    height: 22px;
    margin: inherit;
    margin-top: 4px;
    font-size: 10px;
    text-transform: uppercase;
    border: 1px solid #f1f1f1;
    border-radius: 5px;
    font-size: 12px;
}

.custom-select {
    font-size: 12px;
}

#exampleFormControlTextarea1 {
    font-size: 12px;
}