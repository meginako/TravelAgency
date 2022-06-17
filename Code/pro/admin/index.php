<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>
<div class="content">
    <h5 class="mt-4 mb-2">Hi, <?php echo $fullname ?></h5>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Passengers</span>
                    <span class="info-box-number"><?php
                                                    echo $reg =  $conn->query("SELECT * FROM passenger")->num_rows;
                                                    ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <?php  
                    ?>
                </div>
                
            </div>
            
        </div>
       
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Agencies</span>
                    <span class="info-box-number"><?php
                                                    echo $comp = $conn->query("SELECT * FROM users where id != 1")->num_rows;
                                                    ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <?php  
                    ?>
                </div>
                
            </div>
            
        </div>
         
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-secondary">
                <span class="info-box-icon"><i class="far fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Managers</span>
                    <span
                        class="info-box-number"><?php echo connect()->query("SELECT * FROM menager_and_marketing where type = 2")->num_rows ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <?php 
                    ?>
                </div>
                
            </div>
             
        </div>
       
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Marketer</span>
                    <span class="info-box-number"><?php echo connect()->query("SELECT * FROM menager_and_marketing where type = 3")->num_rows ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>

                </div>
                
            </div>
            
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Payment</span>
                    <span class="info-box-number">$ <?php
                    //we are here ??????????????????????????????????????????????????????????????????????????????????????????????????
                                                            $row = connect()->query("SELECT SUM(price) AS amount FROM ads  ")->fetch_assoc();
                                                            echo $row['amount'] == null ? '0' : $row['amount'];
                                                            ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>

                </div>
               
            </div>
           
        </div>

         
    </div>
 
</div>
 
</div>  
</div> 

</div>