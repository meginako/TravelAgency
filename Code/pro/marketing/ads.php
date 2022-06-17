<?php
include 'marketing_session.php';
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'ads';
$me = "?page=$source";
?>

<div class="content">
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                All Adss</h3>
                            <div class='float-right'>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#add">
                                    Add New Ad &#128645;
                                </button></div>
                        </div>

                        <div class="card-body">

                            <table id="example1" style="align-items: stretch;"
                                class="table table-hover w-100 table-bordered table-striped<?php //
                                                                                                                                            ?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ad Id</th>
                                        <th>Schedule Id</th>
                                        <th>Vehicle</th>
                                        <th>Route</th>
                                        <th>Number Of Days</th>
                                        <th>Remaining Days</th>
                                        <th>Price</th>

                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     //we are here ???????????????????????????????????????????????
                                    $row = $conn->query("SELECT * FROM ads where agency_id = '$agency_id' ");
                                    if ($row->num_rows < 1) echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['id'];
                                        $schedule_id=$fetch['schedule_id'];



                                       
                                        $row1 = $conn->query("SELECT * FROM schedule where id='$schedule_id' ");
                                        if ($row1->num_rows < 1) echo "No Records Yet";
                                      
                                        while ($fetch1 = $row1->fetch_assoc()) {
                                            $vehicle_id = $fetch1['train_id'];
                                            $route_id= $fetch1['route_id'];
                                        }

                                        $row2 = $conn->query("SELECT * FROM train where id='$vehicle_id' ");
                                        if ($row2->num_rows < 1) echo "No Records Yet";
                                        
                                        while ($fetch2 = $row2->fetch_assoc()) {
                                            $vehicle = $fetch2['name'];
                                        }


                                        $row3 = $conn->query("SELECT * FROM route where id='$route_id' ");
                                        if ($row->num_rows < 1) echo "No Records Yet";
                                        
                                        while ($fetch2 = $row3->fetch_assoc()) {
                                            $start= $fetch2['start'];
                                            $stop= $fetch2['stop'];
                                        }

                                        

                                    ?>

                                    <tr>


                                    
                                        <td><?php echo ++$sn; ?></td>
                                        <td><?php echo $fullname = $fetch['id']; ?></td>
                                        <td><?php echo $fetch['schedule_id']; ?></td>
                                        <td><?php echo $vehicle; ?></td>
                                        <td><?php echo $start ." - ".$stop; ?></td>
                                        <td><?php echo $fetch['type']; ?></td>
                                        <td><?php echo $fetch['schedule_id']; ?></td>
                                        <td>$<?php echo number_format($fetch['price'], 2); ?></td>
                                        
                                        
                                    
                                    </tr>

                                    
                                        
                                        <?php
                                    }
                                        ?>

                                </tbody>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
</div>
</section>
</div>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Add New Ad &#128646;
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <table class="table table-bordered">
                    <div class="col-sm-6">
                            Schedule Id : <select class="form-control" name="schedule_id" required id="">
                                <option value="">Select Schedule Id</option>
                                <?php
                                $con4 = connect()->query("SELECT * FROM schedule where agency_id = '$agency_id'");
                                while ($row4 = $con4->fetch_assoc()) {
                                    echo "<option value='" . $row4['id'] . "'>" . $row4['id'] . "</option>";
                                }
                                ?>
                            </select>
                     </div>
                     <div class="col-sm-6">
                            Number of Days : 
                            <td><input type="number" min='0' class="form-control" name="type" required id=""></td>
                       
                       
                        <tr>
                            <td colspan="2">

                                <input class="btn btn-info" type="submit" value="Add Ad" name='submit'>
                            </td>
                        </tr>
                    </table>
                </form>



            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php

if (isset($_POST['submit'])) {
    $schedule_id = $_POST['schedule_id'];
    $type = $_POST['type'];

    $row3 = $conn->query("SELECT * from pricing  ");
    if ($row3->num_rows < 1) echo "No Records Yet";
   
    while ($fetch = $row3->fetch_assoc()) {
        $id = $fetch['id'];
   



    if($type ==1)
    {
        $price = $fetch['level1'];
    }
    else if($type > 1 && $type <=7)
    {
        $price=$type * $fetch['level2'];
    }
    else if($type > 7 && $type <=15)
    {
        $price=$type * $fetch['level3'];
    }
    else if($type > 15 && $type <=30)
    {
        $price=$type * $fetch['level4'];
    }
    else if($type > 30 && $type <=60)
    {
        $price=$type * $fetch['level5'];
    }
    else{
        $price=$type * $fetch['level6'];
    }

    }
    $second_seat = $_POST['second_seat'];

    if (!isset($schedule_id, $type)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        //Check if train exists
        $check = $conn->query("SELECT * FROM ads WHERE schedule_id = '$schedule_id' ")->num_rows;
        if ($check) {
            alert("Ad exists");
        } else {
            $ins = $conn->prepare("INSERT INTO ads (agency_id,schedule_id, type, price ) VALUES (?,?,?,?)");
            $ins->bind_param("iiid", $agency_id, $schedule_id, $type, number_format($price, 2));
            $ins->execute();
            alert("Ad Added!");
            load($_SERVER['PHP_SELF'] . "$me");
        }
    }
}

?>