<?php
include 'marketing_session.php';
if (!isset($file_access)) die("Direct File Access Denied");
?>
<div class="content">
    <h5 class="mt-4 mb-2">Hi, <?php echo $fullname ?></h5>
    <div class="row">
      
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fa fa-train"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Vehicles</span>
                    <span class="info-box-number"><?php
                    //we are here ??????????????????????????????????????????????????????????????????????????????????????????????????
                                                    echo $comp = $conn->query("SELECT * FROM train where agency_id = '$agency_id' ")->num_rows;
                                                    ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <?php //readonly  
                    ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-secondary">
                <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Schedules</span>
                    <!-- we are here ?????????????????????????????????????????????????????????????????????????????????????????????????? -->
                    <span
                        class="info-box-number"><?php echo connect()->query("SELECT * FROM schedule where agency_id = '$agency_id' ")->num_rows ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <?php //readonly  
                    ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
 <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fa fa-route"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Routes</span>
                   <!-- we are here ?????????????????????????????????????????????????????????????????????????????????????????????????? -->
                    <span class="info-box-number"><?php echo connect()->query("SELECT * FROM route where agency_id = '$agency_id' ")->num_rows ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col-md-6 -->
    </div>

    <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fa fa-route"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ads</span>
                   <!-- we are here ?????????????????????????????????????????????????????????????????????????????????????????????????? -->
                    <span class="info-box-number"><?php echo connect()->query("SELECT * FROM ads where agency_id = '$agency_id' ")->num_rows ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col-md-6 -->
    </div>

    <div class="row">
       

       
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- /.col -->
</div>
<!-- /.row -->

</div>