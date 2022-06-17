<?php
include 'marketing_session.php';
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'ads';
$me = "?page=$source";
?>

<div class="content">
    <!-- Main content -->
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

                                     <!--   <th style="width: 30%;">Action</th> -->
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
                                        $sn = 0;
                                        while ($fetch1 = $row1->fetch_assoc()) {
                                            $vehicle_id = $fetch1['train_id'];
                                            $route_id= $fetch1['route_id'];
                                        }

                                        $row2 = $conn->query("SELECT * FROM train where id='$vehicle_id' ");
                                        if ($row2->num_rows < 1) echo "No Records Yet";
                                        $sn = 0;
                                        while ($fetch2 = $row2->fetch_assoc()) {
                                            $vehicle = $fetch2['name'];
                                        }


                                        $row3 = $conn->query("SELECT * FROM route where id='$route_id' ");
                                        if ($row->num_rows < 1) echo "No Records Yet";
                                        $sn = 0;
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
                                        <td><?php echo $fetch['price']; ?></td>
                                        
                                        
                                       <!-- <td>
                                            <form method="POST">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#edit<?php echo $id ?>">
                                                    Edit
                                                </button> -

                                                <input type="hidden" class="form-control" name="del_train"
                                                    value="<?php echo $id ?>" required id="">
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure about this?')"
                                                    class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td> -->
                                    </tr>

                                    <div class="modal fade" id="edit<?php echo $id ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editing <?php echo $fullname;


                                                                                        ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <input type="hidden" class="form-control" name="id"
                                                            value="<?php echo $id ?>" required id="">
                                                        <p>Vehicle Name : <input type="text" class="form-control"
                                                                name="name" value="<?php echo $fetch['name'] ?>"
                                                                required minlength="3" id=""></p>
                                                        <p>First Class Capacity : <input type="number" min='0'
                                                                class="form-control"
                                                                value="<?php echo $fetch['first_seat'] ?>"
                                                                name="first_seat" required id="">
                                                        </p>
                                                        <p> Class Capacity : <input type="number" min='0'
                                                                class="form-control"
                                                                value="<?php echo $fetch['second_seat'] ?>"
                                                                name="second_seat" required id="">
                                                        </p>
                                                        <p>

                                                            <input class="btn btn-info" type="submit" value="Edit Ad"
                                                                name='edit'>
                                                        </p>
                                                    </form>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
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
    if($type ==1)
    {
        $price = 0.3;
    }
    else if($type > 1 && $type <=7)
    {
        $price=$type * 0.26;
    }
    else if($type > 7 && $type <=15)
    {
        $price=$type * 0.23;
    }
    else if($type > 15 && $type <=30)
    {
        $price=$type * 0.2;
    }
    else if($type > 30 && $type <=60)
    {
        $price=$type * 0.18;
    }
    else{
        $price=$type * 0.15;
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
            $ins = $conn->prepare("INSERT INTO ads (agency_id,schedule_id, type, price,active ) VALUES (?,?,?,?,?)");
            $ins->bind_param("iiidi", $agency_id, $schedule_id, $type, $price,1);
            $ins->execute();
            alert("Ad Added!");
            load($_SERVER['PHP_SELF'] . "$me");
        }
    }
}

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $first_seat = $_POST['first_seat'];
    $second_seat = $_POST['second_seat'];
    $id = $_POST['id'];
    if (!isset($name, $first_seat, $second_seat)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        //Check if train exists
        $check = $conn->query("SELECT * FROM ads WHERE name = '$name' ")->num_rows;
        if ($check == 2) {
            alert("Vehicle name exists");
        } else {
            $ins = $conn->prepare("UPDATE ads SET name = ?, first_seat = ?, second_seat = ? WHERE id = ?");
            $ins->bind_param("sssi", $name, $first_seat, $second_seat, $id);
            $ins->execute();
            alert("Vehicle Modified!");
            load($_SERVER['PHP_SELF'] . "$me");
        }
    }
}

if (isset($_POST['del_train'])) {
    $con = connect();
    $conn = $con->query("DELETE FROM ads WHERE id = '" . $_POST['del_train'] . "'");
    if ($con->affected_rows < 1) {
        alert("Vehicle Could Not Be Deleted. This Vehicle Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    } else {
        alert("Vehicle Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>