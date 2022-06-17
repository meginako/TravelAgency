<?php
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'payment';

?>
<div class="content">



    <div class="row">
        <div class="container-fluid">
            <div class="col-lg-12">


                <div class="card card-success">
                    <div class="card-header border-0">
                        <h3 class="card-title">All Payments</h3>

                    </div>
                    <div class="card-body">
                        <table id='example1' class="table table-striped table-bordered table-hover table-valign-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ticket</th>
                                    <th>Vehicle</th>
                                    <th>Route</th>
                                    <th>Passenger</th>
                                  
                                    <th>Price</th>
                                    <th>Class</th>
                                    <th># Places</th>
                                    <th>Seat</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = $conn->query("SELECT * FROM booked INNER JOIN  schedule on booked.schedule_id = schedule.id INNER JOIN payment ON payment.id = booked.payment_id INNER JOIN passenger ON   passenger.id = booked.user_id WHERE payment.agency_id = '$agency_id'");

                               
                                 $sn = 0;

                                while ($val = $row->fetch_assoc()) {
                                    $id = $val['id'];
 
                                    $sn++;
                                    echo "<tr>
                                     <td>" . $sn . "</td>
                                     <td>" . $val['code'] . "</td>
                                      <td>" . getVehicleName($val['train_id']) . "</td>
                                      <td>" . getRoutePath($val['route_id']) . "</td>
                                      <td> " . $val['name']. "</td>
                                      
                                      
                                      <td>$ " . $val['amount']. "</td>
                                      <td>" . $val['class'] . "</td>
                                      <td> " .$val['no']. "</td>
                                      <td>" . $val['seat'] . "</td>
                                      <td> " .$val['date']. "</td>
                                      
                                      </tr>";
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