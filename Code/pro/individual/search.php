<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>
<?php

$me = $_SESSION['user_id'];

?>
<br>



<div class="content">
    
<form action="<?php echo $_SERVER['PHP_SELF'].'?page=search' ?>" method="post">
    <div class="form-row">
        <div class="col">
        <input type="text" class="form-control" placeholder="Start" name="start">
        </div>
        <div class="col">
        <input type="text" class="form-control" placeholder="Destination" name="stop">
        </div>
        <div class="col">
        <input type="date" class="form-control" name = "calendar">
        </div>
        <div class="col">
        <button type="submit" class="btn btn-danger btn-lg" name="search" data-toggle="modal"> <i class="fa fa-search nav-icon"></i> Search </button>
        </div>
    </div>
    </form>

<br>



  
    <section class="content">
        <div class="container-fluid">
        
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Book Transport Tickets</b></h3>
                </div>

        <?php
                if (isset($_POST['search'])) {
        ?>


                <div class="card-body">
                    <table id="example1" style="align-items: stretch;"
                        class="table table-hover w-100 table-bordered table-striped<?php //
                                                                                                                                    ?>">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agency </th>
                                <th> Vehicle </th>
                                <th>Route</th>
                                <th>Status</th>
                                <th>Date/Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if( !empty($_POST['start']) && !empty($_POST['stop'])  && !empty($_POST['calendar'])){
                        
                                $row = searchThree($_POST['start'],$_POST['stop'],$_POST['calendar']);
                            }else if( !empty($_POST['start']) && !empty($_POST['stop'])){
                                
                                $row = searchTwo($_POST['start'],$_POST['stop']);
                            }else if ( !empty($_POST['start'])){
                                
                                $row = searchStart($_POST['start']);

                            }else if ( !empty($_POST['stop'])){
                                
                                $row = searchDestination($_POST['stop']);

                            } else {
                                
                                
                                
                                $row = searchDate($_POST['calendar']);
                                
                            }
                            if ($row->num_rows < 1) echo "<div class='alert alert-danger' role='alert'>
                            Sorry, There are no schedules with the searched data! Please make another search.
                          </div>";
                            $sn = 0;

                            while ($fetch = $row->fetch_assoc()) {
                                 
                                $db_date = $fetch['date'];
                                if ($db_date == date('d-m-Y')) {
                                   
                                    $db_time = $fetch['time'];
                                    $current_time = date('H:i');
                                    if ($current_time >= $db_time) {
                                        continue;
                                    }
                                }
                                $id = $fetch['id']; ?><tr>
                                
                                <td><?php echo ++$sn; ?></td>
                                
                                <td><?php echo $res=getAgencyName($fetch['agency_id']);?></td>
                                
                                <td> <?php echo $vehcileName = getVehicleName($fetch['train_id'])?> </td>

                                <td><?php echo $fullname =  getRoutePath($fetch['route_id']);?></td>
                                <td><?php $array = getTotalBookByType($id);
                                        echo ($max_first = ($array['first'] - $array['first_booked'])), " Seat(s) Available for First Class" . "<hr/>" . ($max_second = ($array['second'] - $array['second_booked'])) . " Seat(s) Available for Second Class";
                                        ?></td>
                                <td><?php echo $fetch['date'], " / ", formatTime($fetch['time']); ?></td>
                                
                                <td>

                                    <form method="post">
                                            
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#book<?php echo $id ?>">
                                        Book
                                    </button>
                                    <?php

                                            if(isFollowing($fetch['agency_id'])){
                                                
                                                ?>
                    

                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#unfllw1<?php echo $id ?>">
                                        Unfollow
                                    </button>

                                    <div class="modal fade" tabindex="-1" role="dialog" id = "unfllw1<?php echo $id ?>" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                            
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">You are unfollowing <?php echo $res=getAgencyName($fetch['agency_id']);?></h4>
                                           
                                                    <br> <br> <br>
                                            <div class="modal-body">
                                                    <?php unfollow($fetch['agency_id'])?>
                                            
                                            <form action="<?php echo $_SERVER['PHP_SELF']."?page=test"?>" method="post">   
                                             <input type="submit" name="submit" class="btn btn-warning"
                                                    value="OK">

                                            </form>

                                            </div>
                                       
                                        </div>
                                    </div>





                                    <?php
                                            } 
                                            else {
                                    ?>



                                        
                                    <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#fllw1<?php echo $id ?>">
                                        Follow
                                    </button>

                                    <div class="modal fade" tabindex="-1" role="dialog" id = "fllw1<?php echo $id ?>" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                            
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">You are following <?php echo $res=getAgencyName($fetch['agency_id']);?></h4>
                                           
                                                    <br> <br> <br>
                                            <div class="modal-body">
                                                    <?php follow($fetch['agency_id'])?>
                                            
                                            <form action="<?php echo $_SERVER['PHP_SELF'] . "?page=test1"?>" method="post">
                                                <input type="submit" name="submit" class="btn btn-success"
                                                    value="OK">

                                            </form>

                                            </div>
                                       
                                        </div>
                                    </div>
                                    
                                    <?php }?>
                                    
                                    </form>
                                </td>
                            </tr>




                            <div class="modal fade" id="book<?php echo $id ?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Book For <?php echo $fullname;?> &#128642;</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">


                                            <form action="<?php echo $_SERVER['PHP_SELF'] . "?loc=$id" ?>"
                                                method="post">
                                                <input type="hidden" class="form-control" name="id"
                                                    value="<?php echo $id ?>" required id="">

                                                <p>Number of Tickets (If you are the only one, leave as it is) :
                                                    <input type="number" min='1' value="1"
                                                        max='<?php echo $max_first >= $max_second ? $max_first : $max_second ?>'
                                                        name="number" class="form-control" id="">
                                                </p>
                                                <p>
                                                    Class : <select name="class" required class="form-control" id="">
                                                        <option value="">-- Select Class --</option>
                                                        <option value="first">First Class ($
                                                            <?php echo ($fetch['first_fee']); ?>)</option>
                                                        <option value="second">Second Class ($
                                                            <?php echo ($fetch['second_fee']); ?>)</option>
                                                    </select>
                                                </p>
                                                <input type="submit" name="submit" class="btn btn-success"
                                                    value="Proceed">

                                            </form>

                                        </div>
                                        
                                    </div>
                                    
                                </div>
                               

                                <?php
                            }
                                ?>

                        </tbody>
                        
                    </table>
                    <?php 
                }
                    
                    ?>
                </div>
                
            </div>
        </div>
    </section>

    </form>

</div>



