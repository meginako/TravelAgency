<?php
@session_start();
$file_access = true;
include '../conn.php';
include 'admin_session.php';
include '../constants.php';
if (@$_GET['page'] == 'print' && isset($_GET['code'])) {
    printClearance($_GET['code']);
    // echo "<script>window.location='admin.php'</script>";
}
if (@$_GET['page'] == 'report' && isset($_GET['id'])) {
    printReport($_GET['id']);
    // echo "<script>window.location='admin.php'</script>";
}

$fullname =  "System Administrator";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <title><?php echo SITE_NAME, ' - ', ucwords($_SESSION['category']); ?> </title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar  navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="navbar-nav">
                    <a class="nav-link" href="#"><?php echo SITE_NAME ?></a>

                </li>
            </ul>


            <!-- Right navbar links -->

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-success elevation-4">
            <!-- Brand Logo -->
            <a href="admin.php" class="brand-link">

                <span class="brand-text font-weight-light"><?php echo date("D d, M y"); ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="images/trainlg.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="admin.php" class="nav-link <?php if (!isset($_GET['page'])) echo 'active'; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Home
                                </p>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="admin.php?page=users" class="nav-link 
                            <?php
                            echo (@$_GET['page'] == 'users') ? 'active' : '';
                            ?>
                            ">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="admin.php?page=dynamic" class="nav-link 
                            <?php
                            echo (@$_GET['page'] == 'dynamic') ? 'active' : '';
                            ?>
                            ">
                                <i class="nav-icon fas fa-calendar-day"></i>
                                <p>
                                    Schedules
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin.php?page=route" class="nav-link      <?php
                                                                                echo (@$_GET['page'] == 'route') ? 'active' : '';
                                                                                ?>">
                                <i class="nav-icon fas fa-route"></i>
                                <p>
                                    Routes
                                </p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a href="admin.php?page=train" class="nav-link      <?php
                                                                                echo (@$_GET['page'] == 'train') ? 'active' : '';
                                                                                ?>">
                                <i class="nav-icon fas fa-train"></i>
                                <p>
                                    Vehicles 
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="admin.php?page=report" class="nav-link      <?php
                                                                                    echo (@$_GET['page'] == 'report') ? 'active' : '';
                                                                                    ?>">
                                <i class="nav-icon fas fa-file-pdf"></i>
                                <p>
                                    Report
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="admin.php?page=payment" class="nav-link      <?php
                                                                                    echo (@$_GET['page'] == 'payment') ? 'active' : '';
                                                                                    ?>">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Payments
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="admin.php?page=feedback" class="nav-link      <?php
                                                                                    echo (@$_GET['page'] == 'feedback') ? 'active' : '';
                                                                                    ?>">
                                <i class="nav-icon fas fa-mail-bulk"></i>
                                <p>
                                    Feedbacks
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="admin.php?page=search" class="nav-link      <?php
                                                                                    echo (@$_GET['page'] == 'search') ? 'active' : '';
                                                                                    ?>">
                                <i class="nav-icon fas fa-search"></i>
                                <p>
                                    Search
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="admin.php?page=logout" class="nav-link">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> Administrator Dashboard</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <?php
            if (!isset($_GET['page']))
                include 'admin/index.php';
            elseif ($_GET['page'] == 'dynamic')
                include 'admin/dynamic_schedule.php';
            elseif ($_GET['page'] == 'report')
                include 'admin/report.php';
            elseif ($_GET['page'] == 'train')
                include 'admin/train.php';
            elseif ($_GET['page'] == 'users')
                include 'admin/users.php';
            elseif ($_GET['page'] == 'route')
                include 'admin/route.php';
            elseif ($_GET['page'] == 'logout') {
                @session_destroy();
                echo "<script>alert('You are being logged out'); window.location='../';</script>";
                exit;
            } elseif ($_GET['page'] == 'payment')
                include 'admin/sales.php';

            elseif ($_GET['page'] == 'feedback')
                include 'admin/feedback.php';

            elseif ($_GET['page'] == 'search')
                include 'admin/search.php';

            else {
                include 'admin/index.php';
            }
            //TODO:
            ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <?php echo SITE_NAME; ?>
            </div>
            <!-- Default to the left -->
            <strong><?php echo date("Y"); ?> - All Rights Reserved</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/demo.js"></script>
    <script src="dist/js/pages/dashboard3.js"></script>

    <script>
    $(function() {
        $("#example1").DataTable();
    });
    </script>
    <?php if (@$_GET['page'] == 'query') { ?>
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- page script -->
    <script>
    $(function() {
        /* jQueryKnob */

        $('.knob').knob({
            draw: function() {}
        })

    })
    </script>
    <?php } ?>

</body>

</html>