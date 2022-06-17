<?php
require_once '../constants.php';
if (!isset($file_access)) die("Direct File Access Denied");
?>

<div class="content">
    <div class="container-fluid">
        <?php
        if (!isset($_POST['submit'])) {
        ?>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header alert-success">
                        <h5 class="m-0">Quick Tips</h5>
                    </div>
                    <div class="card-body">
                        Use the links at the left.
                        <br />You can see list of schedules by clicking on "New Booking". The system will display list
                        of available schedules for you which you can view and make bookings from. <br>Before your
                        bookings are saved, you are redirected to make payment. <br>After a successful payment, system
                        generates your ticket ID for you which you are required to bring to the station. <br>You are
                        allowed to view all your booking history by clicking on "View Bookings".
                    </div>
                </div>
            </div><?php
                    } else {
                        $class = $_POST['class'];
                        $number = $_POST['number'];
                        $schedule_id = $_POST['id'];
                        if ($number < 1) die("Invalid Number");
                        ?>
        
            <div class="row">
                <div class="col-lg-12">
                <form method="post">
                    <div class="card">
                        <div class="card-header alert-success">
                            <h5 class="m-0">Booking Preview</h5>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> <?php echo ucwords($class), " Class" ?>:</h5>
                                You are about to book
                                <?php echo $number, " Ticket", $number > 1 ? 's' : '', ' for ', getRouteFromSchedule($schedule_id); ?>
                                <br />

                                <?php



                                    $fee = ($_SESSION['amount'] = getFee($schedule_id, $class));
                                    echo $number, " x $", $fee, " = $", ($fee * $number), "<hr/>";
                                    $fee = $fee * $number;
                                    $amount = intval($fee);
                                    $vat = ceil($fee * 0.01);
                                    echo "V.A.T Charges = $$vat<br/><br/><hr/>";
                                    echo "Total = $", $total = $amount + $vat;
                                    $fee =  intval($total) . "00";
                                    $_SESSION['amount'] =  $total;
                                    $_SESSION['original'] =  $fee;
                                    $_SESSION['schedule'] =  $schedule_id;
                                    $_SESSION['no'] =  $number;
                                    $_SESSION['class'] =  $class;

                                    pay(getAgencyId($schedule_id),$schedule_id,$total,'MEGI');

                                    $payment_id=getPaymentId($schedule_id);

                                    book($schedule_id,$number,$class,$payment_id);

                                    load($_SERVER['PHP_SELF']."?page=paid");
                                    ?>

                            </div>
                            
                            
                                <button type="submit" class="btn btn-primary" name="submitPay" data-toggle="modal">Pay Now</button>
                                        </form>
                        </div>
                    </div>
                </div>
            
                <?php


 

                    }
                ?>
            </div>
        </div>
    </div>
</div>

