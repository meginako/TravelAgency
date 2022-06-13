<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Analysis Report</h1>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
<?php

if (!isset($_GET['cat'])) {

?>
<section class="content">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <!-- jQuery Knob -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Gender and Registration Analysis
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <?php

                                $ma = $conn->query("SELECT * FROM individual WHERE gender = 'Male' ")->num_rows;
                                $fa = $conn->query("SELECT * FROM individual WHERE gender = 'Female' ")->num_rows;
                                $total_gender = $ma + $fa;
                                $male = ($ma / $total_gender) * 100;
                                $female = ($fa / $total_gender) * 100;
                                $female = substr($female, 0, 5);
                                $male = substr($male, 0, 5);
                                ?>
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $male ?>" data-width="90"
                                    data-height="90" data-fgColor="#3c8dbc">

                                <div class="knob-label">Male</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $female ?>" data-width="90"
                                    data-height="90" data-fgColor="#3c8dbc">

                                <div class="knob-label">Female</div>
                            </div>
                            <?php

                                $self = $conn->query("SELECT * FROM individual WHERE registered_by = 'Self' ")->num_rows;
                                $unself = $conn->query("SELECT * FROM individual WHERE registered_by != 'Self'")->num_rows;
                                $total_self_unself = $self + $unself;
                                $SELF = ($self / $total_self_unself) * 100;
                                $UNSELF = ($unself / $total_self_unself) * 100;
                                $SELF = substr($SELF, 0, 5);
                                $UNSELF = substr($UNSELF, 0, 5);
                                ?>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $SELF ?>" data-max="100"
                                    data-width="90" data-height="90" data-fgColor="#00a65a">

                                <div class="knob-label">Self Regs.</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $UNSELF ?>" data-width="90"
                                    data-height="90" data-fgColor="#00c0ef">

                                <div class="knob-label">Hospital Regs.</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                        <?php

                            $pending = $conn->query("SELECT * FROM individual WHERE reg_status = 'Pending' ")->num_rows;
                            $completed = $conn->query("SELECT * FROM individual WHERE reg_status = 'Completed'")->num_rows;
                            $total_status = $completed + $pending;
                            $Pending = ($pending / $total_status) * 100;
                            $Completed = ($completed / $total_status) * 100;
                            $Pending = substr($Pending, 0, 5);
                            $Completed = substr($Completed, 0, 5);
                            ?>
                        <div class="row">
                            <div class="col-6 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $Completed ?>"
                                    data-width="90" data-height="90" data-fgColor="#932ab6">

                                <div class="knob-label">Completed</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $Pending ?>" data-width="90"
                                    data-height="90" data-fgColor="#39CCCC">

                                <div class="knob-label">Pending</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            <?php
                                $avg = $conn->query("SELECT AVG(father_age) as fa, AVG(mother_age) as ma FROM `individual`")->fetch_assoc();
                                $fa = floor($avg['fa']);
                                $ma = floor($avg['ma']);
                                ?>
                            Parent Data and State Analysis
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $fa ?>" data-skin="tron"
                                    data-width="90" data-height="90" data-fgColor="#00a65a" data-readonly="true">

                                <div class="knob-label">Average Father's Age</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $ma ?>" data-skin="tron"
                                    data-width="90" data-height="90" data-fgColor="#00a65a">

                                <div class="knob-label">Average Mother's Age</div>
                            </div>
                            <!-- ./col -->
                            <?php

                                $fetch_state = $conn->query("SELECT  state.state AS state_id, COUNT(state_id) as c
                            from individual
                            INNER JOIN state ON state.id = individual.state_id
                            GROUP by state_id
                            ORDER by COUNT(*) desc LIMIT 1");
                                if ($fetch_state->num_rows < 1) {
                                    $used = 0;
                                    $state_id = "Unavailable";
                                } else {
                                    $fetch_state = $fetch_state->fetch_assoc();
                                    $used = $fetch_state['c'];
                                    $used = ($used / $total_gender) * 100;
                                    $used = substr($used, 0, 5);
                                    $state_id = "Most State : " . $fetch_state['state_id'];
                                }
                                ?>
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $used; ?>" data-skin="tron"
                                    data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a">

                                <div class="knob-label"><?php echo $state_id ?></div>
                            </div> <?php

                                        $fetch_hos = $conn->query("SELECT  npc_reg_data.hospital_name AS state_id, COUNT(individual.registered_by) as c
                            from individual
                            INNER JOIN npc_reg_data ON npc_reg_data.id = individual.registered_by
                            WHERE individual.registered_by != 'Self'
                            GROUP by individual.registered_by
                            ORDER by COUNT(*) desc LIMIT 1");
                                        if ($fetch_hos->num_rows < 1) {
                                            $used = 0;
                                            $state_id = "Unavailable";
                                        } else {
                                            $fetch_hos = $fetch_hos->fetch_assoc();
                                            $used = $fetch_hos['c'];
                                            $used = ($used / $total_gender) * 100;
                                            $used = substr($used, 0, 5);
                                            $state_id = "Highest Hospital <hr/>" . $fetch_hos['state_id'];
                                        }
                                        ?>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" readonly class="knob" value="<?php echo $used ?>" data-skin="tron"
                                    data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" data-width="120"
                                    data-height="120" data-fgColor="#00c0ef">

                                <div class="knob-label"><?php echo $state_id; ?></div>
                            </div>
                            <!-- ./col -->
                        </div>



                        <!-- /.row -->
                    </div>


                    <!-- /.card-body -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Age Analysis
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                            class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 text-center">
                                        <div class="knob-label">Age Analysis</div>

                                        <table class="table table-bordered" id='example1'>
                                            <thead>
                                                <tr>
                                                    <th>Age</th>
                                                    <th>Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $data = array();
                                                    $don = $conn->query("SELECT * FROM individual");
                                                    while ($joke = $don->fetch_assoc()) {
                                                        $age = calculate_age($joke['dob']);
                                                        $age = intval($age);
                                                        if (array_key_exists($age, $data)) {
                                                            $data[$age] += 1;
                                                        } else {
                                                            $data[$age] = 1;
                                                        }
                                                    }
                                                    sort($data);
                                                    $age = 1;
                                                    foreach ($data as $key => $value) {
                                                    ?>
                                                <tr>

                                                    <td><?php
                                                                echo $key ?></td>
                                                    <td><?php echo $value; ?></td>
                                                </tr>
                                                <?php  }
                                                    ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Highest</th>
                                                    <th><?php
                                                            // $data = array();
                                                            if (empty($data)) $data = array(0 => 0);
                                                            $max = array_keys($data, max($data));
                                                            $min = array_keys($data, min($data));
                                                            $max = $max[0];
                                                            $min = $min[0];
                                                            echo max($data), "( For Age $max )";
                                                            ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Lowest</th>
                                                    <th><?php echo min($data), "( For Age $min )"; ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>


                                    <!-- ./col -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                    </div><!-- /.container-fluid -->
</section>

<?php } else {
    if (!isset($_GET['id'])) {
    ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <?php
                                    $total = $conn->query("SELECT * FROM individual")->num_rows;
                                    $get_state = $conn->query("SELECT * FROM state");
                                    $del = 0;
                                    while ($row = $get_state->fetch_assoc()) {
                                        $me = $conn->query("SELECT * FROM individual WHERE state_id = '" . $row['id'] . "'")->num_rows;
                                        $val = ($me / $total) * 100;
                                        $val = substr($val, 0, 4);
                                        ++$del;

                                        echo '
                                    <a href="admin.php?page=query&name=' . $row['state'] . '&cat=state&id=' . $row['id'] . '">                     
    <div class="col-2 col-md-2 text-center">
 
    <input type="text" readonly class="knob" value="' . $val . '" data-skin="tron"
                            data-width="90" data-height="90" data-fgColor="#00a65a">
                            <div class="knob-label"> ' . $row['state'] . '</div></a>
                        </div>
                        ';
                                    }

                                    ?>

                        </div>



                        <!-- /.row -->
                    </div>


                    <!-- /.card-body -->
                </div>

</section>
<?php
    } else {
        $id = $_GET['id'];

    ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            <?php echo htmlspecialchars(@$_GET['name']) ?>
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Full Name</th>
                                            <th>Local Government</th>
                                            <th>Status.</th>
                                            <th>Cert.</th>
                                        </tr>
                                    </thead>
                                    <?php
                                            $i = 0;
                                            $q = $conn->query("SELECT * FROM individual WHERE state_id = '$id'");
                                            while ($row = $q->fetch_assoc()) {
                                                $fullname = $row['fullname'];
                                                $lga = $row['lga'];
                                                $status = $row['status'];
                                                if ($status == 0) $status = "Pending";
                                                elseif ($status == 1) $status = "Approved";
                                                else $status = "Rejected";

                                                if ($status == 'Approved') {
                                                    $cert = $row['code'];
                                                } else {
                                                    $cert = "--------";
                                                }
                                                $i++;
                                                echo "
    <tr>
    <td>$i</td>
    <td>$fullname</td>
    <td>$lga</td>
    <td>$status</td>
    <td>$cert</td>
    </tr>
    ";
                                            }

                                            ?>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SN</th>
                                            <th>Full Name</th>
                                            <th>Local Government</th>
                                            <th>Status.</th>
                                            <th>Cert.</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
</section>

<?php
    }
}
?>