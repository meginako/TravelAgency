

<?php
include 'manager_session.php';
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'dynamic';
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
                                All Dynamic Schedules</h3>
                            <div class='float-right'>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#add">
                                    Add New One-Time Schedule &#128645;
                                </button> - - - <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#add2">
                                    Add Range Schedule &#128645;
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <table id="example1" style="align-items: stretch;"
                                class="table table-hover w-100 table-bordered table-striped<?php //
                                                                                                                                            ?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Vehicle</th>
                                        <th>Route</th>
                                        <th>F.C Fee</th>
                                        <th>S.C Fee</th>
                                        <th>Total Bookings</th>
                                        <th>Date/Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //we are here ????????????????????????????????????????????????????????????
                                    $row = $conn->query("SELECT * FROM schedule where agency_id = '$agency_id' ORDER BY id DESC");

                                    if ($row->num_rows < 1) echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['id']; ?><tr>
                                        <td><?php echo ++$sn; ?></td>
                                        <td><?php echo getTrainName($fetch['train_id']); ?></td>
                                        <td><?php echo getRoutePath($fetch['route_id']);
                                                $fullname = " Schedule" ?></td>
                                        <td>$ <?php echo ($fetch['first_fee']); ?></td>
                                        <td>$ <?php echo ($fetch['second_fee']); ?></td>
                                        <td><?php $array = getTotalBookByType($id);
                                                echo (($array['first'] - $array['first_booked'])), " Seat(s) Available for First Class" . "<hr/>" . ($array['second'] - $array['second_booked']) . " Seat(s) Available for Second Class";
                                                ?></td>
                                        <td><?php echo $fetch['date'], " / ", formatTime($fetch['time']); ?></td>

                                        <td>
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
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit<?php echo $id ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editing <?php echo $fullname;


                                                                                        ?> &#128642;</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">


                                                    <form action="" method="post">
                                                        <input type="hidden" class="form-control" name="id"
                                                            value="<?php echo $id ?>" required id="">

                                                        <p>Vehicle : <select class="form-control" name="train_id" required
                                                                id="">
                                                                <option value="">Select </option>
                                                                <?php
                                                                    $cons = connect()->query("SELECT * FROM train where agency_id = '$agency_id' ");
                                                                    while ($t = $cons->fetch_assoc()) {
                                                                        echo "<option " . ($fetch['train_id'] == $t['id'] ? 'selected="selected"' : '') . " value='" . $t['id'] . "'>" . $t['name'] . "</option>";
                                                                    }
                                                                    ?>
                                                            </select>
                                                        </p>

                                                        <p>Route : <select class="form-control" name="route_id" required
                                                                id="">
                                                                <option value="">Select Route</option>
                                                                <?php
                                                                    $cond = connect()->query("SELECT * FROM route where agency_id = '$agency_id' ");
                                                                    while ($r = $cond->fetch_assoc()) {
                                                                        echo "<option  " . ($fetch['route_id'] == $r['id'] ? 'selected="selected"' : '') . " value='" . $r['id'] . "'>" . getRoutePath($r['id']) . "</option>";
                                                                    }
                                                                    ?>
                                                            </select>
                                                        </p>
                                                        <p>
                                                            First Class Charge : <input class="form-control"
                                                                type="number" value="<?php echo $fetch['first_fee'] ?>"
                                                                name="first_fee" required id="">
                                                        </p>
                                                        <p>
                                                            Second Class Charge : <input class="form-control"
                                                                type="number" value="<?php echo $fetch['second_fee'] ?>"
                                                                name="second_fee" required id="">
                                                        </p>
                                                        <p>
                                                            Date :
                                                            <input type="date" class="form-control"
                                                                onchange="check(this.value)" id="date"
                                                                placeholder="Date" name="date" required
                                                                value="<?php echo (date('Y-m-d', strtotime($fetch["date"]))) ?>">

                                                        </p>
                                                        <p>
                                                            Time : <input class="form-control" type="time"
                                                                value="<?php echo $fetch['time'] ?>" name="time"
                                                                required id="">
                                                        </p>
                                                        <p class="float-right"><input type="submit" name="edit"
                                                                class="btn btn-success" value="Edit Schedule"></p>
                                                    </form>

                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                             
                                            </div>
                                            
                                        </div>
                                         
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
                <h4 class="modal-title">Add New Schedule &#128649;
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            Vehicle : <select class="form-control" name="train_id" required id="">
                                <option value="">Select Vehicle</option>
                                <?php
                                $con = connect()->query("SELECT * FROM train where agency_id = '$agency_id'");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-sm-6">
                            Route : <select class="form-control" name="route_id" required id="">
                                <option value="">Select Route</option>
                                <?php
                                $con = connect()->query("SELECT * FROM route where agency_id = '$agency_id'");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . getRoutePath($row['id']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            First Class Charge : <input class="form-control" type="number" name="first_fee" required
                                id="">
                        </div>
                        <div class="col-sm-6">

                            Second Class Charge : <input class="form-control" type="number" name="second_fee" required
                                id="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            Date : <input class="form-control" onchange="check(this.value)" type="date" name="date"
                                required id="date">
                        </div>
                        <div class="col-sm-6">

                            Time : <input class="form-control" type="time" name="time" required id="">
                        </div>
                    </div>
                    <hr>
                    <input type="submit" name="submit" class="btn btn-success" value="Add Schedule"></p>
                </form>

                <script>
                function check(val) {
                    val = new Date(val);
                    var age = (Date.now() - val) / 31557600000;
                    var formDate = document.getElementById('date');
                    if (age > 0) {
                        alert("Past/Current Date not allowed");
                        formDate.value = "";
                        return false;
                    }
                }
                </script>

            </div>

        </div>
         
    </div>
     
</div>


<div class="modal fade" id="add2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Add Range Schedule &#128649;
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            Vehicle : <select class="form-control" name="train_id" required id="">
                                <option value="">Select Vehicle</option>
                                <?php
                                $con = connect()->query("SELECT * FROM train where agency_id = '$agency_id'");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-sm-6">
                            Route : <select class="form-control" name="route_id" required id="">
                                <option value="">Select Route</option>
                                <?php
                                $con = connect()->query("SELECT * FROM route where agency_id = '$agency_id'");
                                while ($row = $con->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . getRoutePath($row['id']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            First Class Charge : <input class="form-control" type="number" name="first_fee" required>
                        </div>
                        <div class="col-sm-6">

                            Second Class Charge : <input class="form-control" type="number" name="second_fee" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            From Date : <input class="form-control" onchange="check(this.value)" type="date"
                                name="from_date" required>
                        </div>
                        <div class="col-sm-6">
                            End Date : <input class="form-control" onchange="check(this.value)" type="date"
                                name="to_date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"> Every :
                            <select class="form-control" name="every">
                                <option value="Day">Day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>
                        <div class="col-sm-6">

                            Time : <input class="form-control" type="time" name="time" required id="">
                        </div>
                    </div>
                    <hr>
                    <input type="submit" name="submit2" class="btn btn-success" value="Add Schedule"></p>
                </form>

                <script>
                function check(val) {
                    val = new Date(val);
                    var age = (Date.now() - val) / 31557600000;
                    var formDate = document.getElementById('date');
                    if (age > 0) {
                        alert("You are using a past/current date!");
                        val.value = "";
                        return false;
                    }
                }
                </script>

            </div>

        </div>
       
    </div>
     
</div>
<?php

if (isset($_POST['submit'])) {
    $route_id = $_POST['route_id'];
    $train_id = $_POST['train_id'];
    $first_fee = $_POST['first_fee'];
    $second_fee = $_POST['second_fee'];
    $date = $_POST['date'];
    $date = formatDate($date);
     
    $time = $_POST['time'];
    if (!isset($route_id, $train_id, $first_fee, $second_fee, $date, $time)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("INSERT INTO `schedule`(`train_id`, `route_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES (?,?,?,?,?,?)");
        $ins->bind_param("iissii", $train_id, $route_id, $date, $time, $first_fee, $second_fee);
        $ins->execute();
        alert("Schedule Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}


if (isset($_POST['submit2'])) {
    $route_id = $_POST['route_id'];
    $train_id = $_POST['train_id'];
    $first_fee = $_POST['first_fee'];
    $second_fee = $_POST['second_fee'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $every = $_POST['every'];

    $time = $_POST['time'];
    if (!isset($route_id, $train_id, $first_fee, $second_fee, $date, $time)) {
        alert("Fill Form Properly!");
    } else {


        $from_date = formatDate($from_date);
        $to_date = formatDate($to_date);
        $startDate = $from_date;
        $endDate = $to_date;
        $conn = connect();
        if ($every == 'Day') {
            for ($i = strtotime($startDate); $i <= strtotime($endDate); $i = strtotime('+1 day', $i)) {
                $date = date('d-m-Y', $i);
                $ins = $conn->prepare("INSERT INTO `schedule`(`train_id`, `route_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES (?,?,?,?,?,?)");
                $ins->bind_param("iissii", $train_id, $route_id, $date, $time, $first_fee, $second_fee);
                $ins->execute();
            }
        } else {
            for ($i = strtotime($every, strtotime($startDate)); $i <= strtotime($endDate); $i = strtotime('+1 week', $i)) {
                $date = date('d-m-Y', $i);

                $ins = $conn->prepare("INSERT INTO `schedule`(`train_id`, `route_id`, `date`, `time`, `first_fee`, `second_fee`) VALUES (?,?,?,?,?,?)");
                $ins->bind_param("iissii", $train_id, $route_id, $date, $time, $first_fee, $second_fee);
                $ins->execute();
            }
        }


        alert("Schedules Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}


if (isset($_POST['edit'])) {
    $route_id = $_POST['route_id'];
    $train_id = $_POST['train_id'];
    $first_fee = $_POST['first_fee'];
    $second_fee = $_POST['second_fee'];
    $date = $_POST['date'];
    $date = formatDate($date);
    $time = $_POST['time'];
    $id = $_POST['id'];
    if (!isset($route_id, $train_id, $first_fee, $second_fee, $date, $time)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("UPDATE `schedule` SET `train_id`=?,`route_id`=?,`date`=?,`time`=?,`first_fee`=?,`second_fee`=? WHERE id = ?");
        $ins->bind_param("iissiii", $train_id, $route_id, $date, $time, $first_fee, $second_fee, $id);
        $ins->execute();
        $msg = "Having considered user's satisfactions and every other things, we the management are so sorry to let inform you that there has been a change in the date and time of your trip. <hr/> New Date : $date. <br/> New Time : ".formatTime($time)." <hr/> Kindly disregard if the date/time still stays the same.";
        $e = $conn->query("SELECT passenger.email FROM passenger INNER JOIN booked ON booked.user_id = passenger.id WHERE booked.schedule_id = '$id' ");
        while($getter = $e->fetch_assoc()){
            @sendMail($getter['email'], "Change In Trip Date/Time", $msg);
        }
        alert("Schedule Modified!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

if (isset($_POST['del_train'])) {
    $con = connect();
    $conn = $con->query("DELETE FROM schedule WHERE id = '" . $_POST['del_train'] . "'");
    if ($con->affected_rows < 1) {
        alert("Schedule Could Not Be Deleted. This Route Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    } else {
        alert("Schedule Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>