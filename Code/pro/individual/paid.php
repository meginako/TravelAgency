<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>
<?php

if (isset($_GET['now'])) {
    echo "<script>alert('Your payment was successful');window.location='individual.php?page=paid';</script>";
    exit;
}

?>
 


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Info:</h5>
                    Payment History and Print Tickets
                </div>



                <div class="card">
                    <div class="card-header alert-success">
                        <h5 class="m-0">Bookings - Purchased Tickets</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id='example1'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ticket Number</th>
                                    <th>Trip Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $conn = connect()->query("SELECT *, booked.id as id, payment.date as pd FROM `booked` INNER JOIN payment ON booked.payment_id = payment.id INNER JOIN schedule ON schedule.id = booked.schedule_id  WHERE payment.passenger_id = '$user_id' ORDER BY booked.id DESC");
                                $sn = 0;
                                while ($row = $conn->fetch_assoc()) {
                                    $fullname = getRouteFromSchedule($row['schedule_id']);
                                    $id = $row['id'];
                                    $sn++;
                                    echo "<tr>
                                    <td>$sn</td>
                                    <td>" . $row['code'] . "</td>
                                    <td>" . $row['date'] . "</td>
                                    <td>" . ((isScheduleActive($row['schedule_id']) ? '<span class="text-bold text-success">Active' : '<span class="text-bold text-danger">Expired')) . "</span></td>
                                    <td>
                                    <button type='button' class='btn btn-primary' data-toggle='modal'
                                    data-target='#view$id'>
                                    View
                                </button>
                                    </td>

                                    </tr>";
                                ?>
                                <div class="modal fade" id="view<?php echo $id ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Details For - <?php echo $fullname;?> 
                                                <span class="">&#128669;</span></h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">


                                                <p><b>Seat Number :</b>
                                                    <?php echo $row['seat'];
                                                        ?>
                                                </p>
                                                <p><b>Vehicle Name :</b>
                                                    <?php echo getTrainName($row['train_id']);
                                                        ?>
                                                </p>
                                                <p><b>Payment Date :</b>
                                                    <?php echo ($row['pd']);
                                                        ?>
                                                </p>
                                                <p><b>Amount Paid :</b> $
                                                    <?php echo ($row['amount']);
                                                        ?>
                                                </p>
                                                <p><b>Payment Ref :</b>
                                                    <?php echo ($row['ref']);
                                                        ?>
                                                </p>

                                                <?php
                                                    if (isScheduleActive($row['schedule_id'])) echo '<a href="individual.php?page=print&print=' . $id . '"><button  class="btn btn-success">Print Ticket</button></a>';
                                                    else echo '<button disabled="disabled" class="btn btn-danger">Ticket Has Been Expired</button>'; ?>
                                                    
                                                    <?php
                                                     $fet = querySchedule('future');
                                                     $msg = "";
                                                     $output = "<option value=''>Choose One Or Skip To Leave As It Is</option>";
                                                     if ($fet->num_rows < 1) $msg = "<span class='text-danger'>No Upcoming Schedules Yet</span>";
                            while ($fetch = $fet->fetch_assoc()) {
    //Check if the current date is same with Database scheduled date
    $db_date = $fetch['date'];
    if ($db_date == date('d-m-Y')) {
        
        $db_time = $fetch['time'];
        $current_time = date('H:i');
        if ($current_time >= $db_time) {
            continue;
        }
    }
    $fullname =  getRoutePath($fetch['route_id']);
    $datetime = $fetch['date']. " / ". formatTime($fetch['time']);
    $output .= "<option value='$fetch[id]'>$fullname - $datetime</option>";
                            }
                                                    if (isScheduleActive($row['schedule_id'])) echo '<div x-data="{ open: false }"><button @click="open = true" class="btn btn-dark float-right">Modify</button>
                                                    <p x-show="open" @click.away="open = false">
                                                    <form method="POST" >
                                                    '.$msg.'
                                                        <select class="form-control" name="s" required >
                                                            '.$output.'
                                                        </select>
                                                        <input type="hidden" name="pk" value="'.$id.'">
                                                        <input type="submit" name="modify" class="btn btn-primary" value="Submit Form" />
                                                    </form>
                                                    </p>
                                                </div>';
                                                   ?>

 

    
 
                                  </div>
                              </div>
                                        
                                    </div>
                                    <?php
                                }
                                    ?>
                            </tbody>
                        </table>


                    </div>

                    <br />
                </div>
             
            </div> 
        </div> 
    </div> 
</section>
 
</div>

<?php 
if (isset($_POST['modify'])){

    $pk = $_POST['pk'];
    $s = $_POST['s'];
    $db = connect();
    $sql = "UPDATE booked SET schedule_id = '$s' WHERE id = '$pk';";
    // die($sql);
    $query = $db->query($sql);
    if ($query){
        alert("Modification Saved");
        load($_SERVER['PHP_SELF']."?page=paid");
        
    }else{
        alert("Error Occurred While Trying To Save.");
    }
}

?>