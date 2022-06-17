<?php
include 'agency_session.php';
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'users';
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
                                
                                All Users</h3>
                            <div class='float-right'>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#add">
                                    Add New User &#128645;
                                </button></div>
                        </div>

                        <div class="card-body">

                            <table id="example1" style="align-items: stretch;"
                                class="table table-hover w-100 table-bordered table-striped<?php //
                                                                                                                                            ?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Id</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //we are here ???????????????????????????????????????????????
                                    $row = $conn->query("SELECT * FROM menager_and_marketing where agency_id = '$agency_id' ");
                                    if ($row->num_rows < 1) echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['id'];

                                        if($fetch['type'] == 3)
                                        {
                                            $type="Marketer";
                                        }
                                        else if($fetch['type'] == 2)
                                        {
                                            $type="Manager";
                                        }
                                    ?>

                                    <tr>
                                        <td><?php echo ++$sn; ?></td>
                                        <td><?php echo $fetch['id']; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $fetch['name'];?></td>
                                        <td><?php echo $fetch['surname'];?></td>
                                        <td><?php echo $fetch['email'];?></td>
                                        
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
                                                        <p>Name : <input type="text" class="form-control"
                                                                value="<?php echo $fetch['name'] ?>" name="name"
                                                                required id="">
                                                        </p>
                                                        <p>Surname : <input type="text" class="form-control"
                                                                value="<?php echo $fetch['surname'] ?>" name="surname"
                                                                required id="">
                                                        </p>
                                                        <p>Type : <select class="form-control"  value="<?php echo $fetch['type'] ?>" name="type" required id="">                                
                                                            <option value="2">Manager</option>
                                                            <option value="3">Marketer</option>

                                                        </select>
                                                        </p>
                                                        <p>Email : <input type="text" class="form-control"
                                                                value="<?php echo $fetch['email'] ?>" name="email"
                                                                required id="">
                                                        </p>
                                                        <p>Password : <input type="password" class="form-control"
                                                                value="<?php echo $fetch['password'] ?>" name="password"
                                                                required id="">
                                                        </p>
                                                        <p>

                                                            <input class="btn btn-info" type="submit" value="Edit User"
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

<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Add New User &#128649;
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <table class="table table-bordered">

                        <tr>
                            <th>Name</th>
                            <td><input type="text" class="form-control" name="name" required id=""></td>
                        </tr>
                        <tr>
                            <th>Surname</th>
                            <td><input type="text" class="form-control" name="surname" required id=""></td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td><select class="form-control" name="type" required id="">                                
                               
                                    <option value="2">Manager</option>
                                    <option value="3">Marketer</option>
            
                               
                            </select></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" class="form-control" name="email"  required id=""></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input type="password" class="form-control" name="password" required id=""></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">

                                <input class="btn btn-info" type="submit" value="Add User" name='submit'>
                            </td>
                        </tr>
                    </table>
                </form>



            </div>

        </div>
       
    </div>
    
</div>

<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $password= md5($_POST['password']);
    if (!isset($name ,$surname,$email,$password,$type)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
 //we are here ???????????????????????????????????????????????????????????????????
        $ins = $conn->prepare("INSERT INTO menager_and_marketing (agency_id,name,surname,email,password,type) VALUES (?,?,?,?,?,?)");
        $ins->bind_param("issssi",$agency_id, $name,$surname, $email, $password, $type);
        $ins->execute();
        alert("User Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $password= md5($_POST['password']);
    if (!isset($name ,$surname,$email,$password,$type)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("UPDATE menager_and_marketing SET agency_id = ?, name = ?, surname = ?, email = ?,password= ? , type = ? WHERE id = ?");
        $ins->bind_param("issssii",$agency_id, $name,$surname, $email, $password, $type,$_POST['id']);
        $ins->execute();
        alert("User Modified!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

if (isset($_POST['del_train'])) {
    $con = connect();
    $conn = $con->query("DELETE FROM menager_and_marketing WHERE id = '" . $_POST['del_train'] . "'");
    if ($con->affected_rows < 1) {
        alert("User Could Not Be Deleted.");
        load($_SERVER['PHP_SELF'] . "$me");
    } else {
        alert("User Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>