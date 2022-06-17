<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Info:</h5>
                    We always want to hear from you!
                    Replied to within 24-hours.
                </div>



                <div class="card">
                    <div class="card-header alert-success">
                        <h5 class="card-title"><b>List of all Feedbacks</b></h5>
                        <div class='float-right'>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add">
                                Send New Feedback
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id='example1'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Agency Name</th>
                                    <th>Your Comment</th>
                                    <th>Response</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn = 0;
                                $query = getFeedbacks();
                                while ($row = $query->fetch_assoc()) {
                                    $agname =getAgencyName($row['agency_id']);
                                     
                                
                                    echo "<tr>
                                    <td>".$sn."</td>
                                    <td>". $agname."</td>
                                    <td>" . $row['message'] . "</td>
                                    <td>" . ($row['response'] == NULL ? '-- No Response Yet --' : $row['response']) . "</td>
                                    </tr>";
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


<!--================ SEND FEEDBACK  TO  AGENCY   ========================-->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Send New Feedback </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?php echo $_SERVER['PHP_SELF'].'?page=feedback' ?>" method="post">

                <label>Select an agency to give feedback</label> <br>
                <select name="agency" class="form-select" aria-label="Default select example"> 
                   <?php 
                   
                    $row = getFollowedAgencies();
                    $i = 0;
                    while ($fetch = $row->fetch_assoc()) {

                        echo "<option value=".$fetch['id'].">".$fetch['agency_name']."</option>";
                    }
                        ?>
                   
                </select>
           <br><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                Type Message : <textarea name="message" required minlength="10" id="" cols="30"
                                    rows="10" class="form-control"></textarea>
                            </div>

                        </div>


                        <hr>
                        <input type="submit" name="sendFeedback" class="btn btn-success" value="Send"></p>
                </form>


            </div>

        </div>
        
    </div>
    
</div>

<?php

if (isset($_POST['sendFeedback'])) {
    $msg = $_POST['message'];

    $ag = $_POST['agency'];
    
    $send = sendFeedback($msg,$ag);
    echo $send;
    if ($send) {
        echo "<script>alert('Feedback sent! We will get back to you');window.location='individual.php?page=feedback'</script>";
    } else {
        echo "<script>alert('Feedback could not be sent! Try again!');window.location='individual.php?page=feedback'</script>";
    }
     
}

?>