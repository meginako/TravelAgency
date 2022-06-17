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
                                    <th>ID</th>
                                    <th>Agency</th>
                                    <th>Vehicle</th>
                                    <th>Route</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = $conn->query("SELECT * FROM ads INNER JOIN  schedule on ads.schedule_id = schedule.id ");

                               
                               

                                while ($val = $row->fetch_assoc()) {
                                    $id = $val['id'];

                                  
                                    
                                   
                                   
                                    
                                    echo "<tr>
                                     <td>" . $id . "</td>
                                     <td>" . getAgencyName($val['agency_id'] ). "</td>
                                      <td>" . getVehicleName($val['train_id']) . "</td>
                                      <td>" . getRoutePath($val['route_id']) . "</td>
                                      <td> " . $val['type']. "</td>
                                      
                                      
                                      <td>$ " . $val['price']. "</td>
                                      <td>" . $val['active'] . "</td>
                                      
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