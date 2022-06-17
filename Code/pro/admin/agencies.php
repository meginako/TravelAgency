<?php
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'agencies';
$me = "?page=$source";
if (isset($_GET['status'], $_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    if ($status == 0) {
        $status = 0;
    } else {
        $status = 1;
    }
    $conn = connect()->query("UPDATE users SET status = '$status' WHERE id = '$id'");
    echo "<script>alert('Action completed!');window.location='admin.php$me';</script>";
}
?>

<div class="content">
    
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
                                            <th>Description</th>
                                            <th>NIPT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $row = connect()->query("SELECT * FROM users where id != 1 ORDER BY id DESC");
                                        if ($row->num_rows < 1) echo "No Records Yet";
                                        $sn = 0;
                                        while ($fetch = $row->fetch_assoc()) {
                                            $id = $fetch['id']; ?><tr>
                                            <td><?php echo ++$sn; ?></td>
                                            <td><?php echo ($fetch['full_name']); ?></td>
                                            <td><?php echo ($fetch['email']); ?></td>
                                            <td><?php echo ($fetch['phone']); ?></td>
                                            <td><?php echo ($fetch['Description']); ?></td>
                                            <td><?php echo ($fetch['nipt']); ?></td>
                                            <td>
                                                <?php
                                                    if ($fetch['status'] == 0) {
                                                    ?>
                                                <a href="admin.php?page=agencies&status=1&id=<?php echo $id; ?>">
                                                    <button
                                                        onclick="return confirm('You are about allowing this user be able to login his/her account.')"
                                                        type="submit" class="btn btn-success">
                                                        Enable Account
                                                    </button></a>
                                                <?php } else { ?>
                                                <a href="admin.php?page=agencies&status=0&id=<?php echo $id; ?>">
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





