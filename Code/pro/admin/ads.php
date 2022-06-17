<?php
include 'admin_session.php';
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'ads';
$me = "?page=$source"
?>

<div class="content">
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                Ad Pricing</h3>
                                <div class='float-right'>
                               </div>
                        </div>

                        
                            

                        <div class="card-body">

                            <table id="example1" style="align-items: stretch;"
                                class="table table-hover w-100 table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>One Day</th>
                                        <th>1 - 7 Daysy</th>
                                        <th>7 - 15 Daysy</th>
                                        <th>15 - 30 Daysy</th>
                                        <th>30 - 60 Daysy</th>
                                        <th>More Than 60 Days</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //we are here ???????????????????????????????????????????????
                                    $row = $conn->query("SELECT * from pricing  ");
                                    if ($row->num_rows < 1) echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['id'];
                                    ?>

                                    <tr>
                                        <td><?php echo $id; ?></td>
                                    
                                        <td>$<?php echo $fetch['level1'];?>  /day</td>
                                        <td>$<?php echo $fetch['level2'];?>   /day</td>
                                        <td>$<?php echo $fetch['level3'];?>   /day</td>
                                        <td>$<?php echo $fetch['level4'];?>   /day</td>
                                        <td>$<?php echo $fetch['level5'];?>   /day</td>
                                        <td>$<?php echo $fetch['level6'];?>   /day</td>

                                        <td>
                                            <form method="POST">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#edit<?php echo $id ?>">
                                                    Edit
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
                                                        <p>Level1: <input type="text" class="form-control"
                                                                value="<?php echo $fetch['level1'] ?>" name="level1"
                                                                required id="">
                                                        </p>
                                                        <p> Level2: <input type="text" class="form-control"
                                                                value="<?php echo $fetch['level2'] ?>" name="level2"
                                                                required id="">
                                                        </p>
                                                        <input type="hidden" class="form-control" name="id"
                                                            value="<?php echo $id ?>" required id="">
                                                        <p>Level3: <input type="text" class="form-control"
                                                                value="<?php echo $fetch['level3'] ?>" name="level3"
                                                                required id="">
                                                        </p>
                                                        <p> Level4: <input type="text" class="form-control"
                                                                value="<?php echo $fetch['level4'] ?>" name="level4"
                                                                required id="">
                                                        </p>
                                                        <input type="hidden" class="form-control" name="id"
                                                            value="<?php echo $id ?>" required id="">
                                                        <p>Level5: <input type="text" class="form-control"
                                                                value="<?php echo $fetch['level5'] ?>" name="level5"
                                                                required id="">
                                                        </p>
                                                        <p> Level6: <input type="text" class="form-control"
                                                                value="<?php echo $fetch['level6'] ?>" name="level6"
                                                                required id="">
                                                        </p>
                                                        <p>

                                                            <input class="btn btn-info" type="submit" value="Edit Pricing"
                                                                name='edit'>
                                                        </p>
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



<?php



if (isset($_POST['edit'])) {
    $level1 = $_POST['id'];
    $level1 = $_POST['level1'];
    $level2 = $_POST['level2'];
    $level3 = $_POST['level3'];
    $level4 = $_POST['level4'];
    $level5 = $_POST['level5'];
    $level6 = $_POST['level6'];

  
    if (!isset ($id, $level1,  $level2, $level3, $level4, $level5, $level6)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("UPDATE pricing SET  level1 = ?,  level2 = ?,  level3 = ?,  level4 = ?,  level5 = ?,  level6 = ? WHERE id = 1");
        $ins->bind_param("dddddd" , $level1, $level2, $level3, $level4, $level5, $level6);
        $ins->execute();
        alert("Ad Pricing Modified!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

