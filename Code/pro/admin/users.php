<?php
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'users';
$me = "?page=$source";
if (isset($_GET['status'], $_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    if ($status == 0) {
        $status = 0;
    } else {
        $status = 1;
    }
    $conn = connect()->query("UPDATE passenger SET status = '$status' WHERE id = '$id'");
    echo "<script>alert('Action completed!');window.location='admin.php$me';</script>";
}
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
                                Registered Users</h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">

                                <table style="width: 100%;" id="example1" style="align-items: stretch;"
                                    class="table table-hover table-bordered">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $row = connect()->query("SELECT * FROM passenger ORDER BY id DESC");
                                        if ($row->num_rows < 1) echo "No Records Yet";
                                        $sn = 0;
                                        while ($fetch = $row->fetch_assoc()) {
                                            $id = $fetch['id']; ?><tr>
                                            <td><?php echo ++$sn; ?></td>
                                            <td><?php echo ($fetch['name']); ?></td>
                                            <td><?php echo ($fetch['email']); ?></td>
                                            <td><?php echo ($fetch['phone']); ?></td>
                                            <td><img src="<?php echo "uploads/" . ($fetch['loc']); ?>"
                                                    class="img img-rounded" width="80" height="80" /></td>


                                            <td>
                                                <?php
                                                    if ($fetch['status'] == 0) {
                                                    ?>
                                                <a href="admin.php?page=users&status=1&id=<?php echo $id; ?>">
                                                    <button
                                                        onclick="return confirm('You are about allowing this user be able to login his/her account.')"
                                                        type="submit" class="btn btn-success">
                                                        Enable Account
                                                    </button></a>
                                                <?php } else { ?>
                                                <a href="admin.php?page=users&status=0&id=<?php echo $id; ?>">
                                                    <button
                                                        onclick="return confirm('You are about denying this user access to  his/her account.')"
                                                        type="submit" class="btn btn-danger">
                                                        Disable Account
                                                    </button></a>
                                                <?php } ?>
                                            </td>
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
                                $con = connect()->query("SELECT * FROM train");
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
                                $con = connect()->query("SELECT * FROM route");
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                                $con = connect()->query("SELECT * FROM train");
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
                                $con = connect()->query("SELECT * FROM route");
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php

if (isset($_POST['submit'])) {
    $route_id = $_POST['route_id'];
    $train_id = $_POST['train_id'];
    $first_fee = $_POST['first_fee'];
    $second_fee = $_POST['second_fee'];
    $date = $_POST['date'];
    $date = formatDate($date);
    // die($date);
    // $endDate = date('Y-m-d' ,strtotime( $data['automatic_until'] ));
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
    $time = $_POST['time'];
    $id = $_POST['id'];
    if (!isset($route_id, $train_id, $first_fee, $second_fee, $date, $time)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("UPDATE `schedule` SET `train_id`=?,`route_id`=?,`date`=?,`time`=?,`first_fee`=?,`second_fee`=? WHERE id = ?");
        $ins->bind_param("iissiii", $train_id, $route_id, $date, $time, $first_fee, $second_fee, $id);
        $ins->execute();
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