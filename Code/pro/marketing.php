<?php
@session_start();
$file_access = true;
include '../conn.php';
include 'marketing_session.php';
include '../constants.php';
if (@$_GET['page'] == 'print' && isset($_GET['code'])) {
    printClearance($_GET['code']);
   
}
if (@$_GET['page'] == 'report' && isset($_GET['id'])) {
    printReport($_GET['id']);
     
}

$fullname =  "Marketer";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <title><?php echo SITE_NAME, ' - ', ucwords($_SESSION['category']); ?> </title>
   
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

         
        <nav class="main-header navbar  navbar-expand navbar-white navbar-light">
            

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="navbar-nav">
                    <a class="nav-link" href="#"><?php echo SITE_NAME ?></a>

                </li>
            </ul>


             

        </nav>
        
        <aside class="main-sidebar sidebar-dark-success elevation-4">
            
            <a href="marketing.php" class="brand-link">

                <span class="brand-text font-weight-light"><?php echo date("D d, M y"); ?></span>
            </a>

           
            <div class="sidebar">
               
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="images/trainlg.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Marketer</a>
                    </div>
                </div>

                 
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                         
                        <li class="nav-item">
                            <a href="marketing.php" class="nav-link <?php if (!isset($_GET['page'])) echo 'active'; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Home
                                </p>
                            </a>

                        </li>

                       

                        <li class="nav-item">
                            <a href="marketing.php?page=dynamic" class="nav-link 
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
                            <a href="marketing.php?page=route" class="nav-link      <?php
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
                            <a href="marketing.php?page=train" class="nav-link      <?php
                                                                                echo (@$_GET['page'] == 'train') ? 'active' : '';
                                                                                ?>">
                                <i class="nav-icon fas fa-train"></i>
                                <p>
                                    Vehicles 
                                </p>
                            </a>
                        </li>

                        </li>
                        <li class="nav-item">
                            <a href="marketing.php?page=ads" class="nav-link      <?php
                                                                                echo (@$_GET['page'] == 'ads') ? 'active' : '';
                                                                                ?>">
                                <i class="nav-icon fas fa-train"></i>
                                <p>
                                   Ads 
                                </p>
                            </a>
                        </li>
                      

                        <li class="nav-item">
                            <a href="marketing.php?page=search" class="nav-link      <?php
                                                                                    echo (@$_GET['page'] == 'search') ? 'active' : '';
                                                                                    ?>">
                                <i class="nav-icon fas fa-search"></i>
                                <p>
                                    Search
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="marketing.php?page=logout" class="nav-link">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                    </ul>
                </nav>
               
            </div>
            
        </aside>

       
        <div class="content-wrapper">
            
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> Marketing  Dashboard</h1>
                        </div> 
                    </div> 
                </div> 
            </div>
            

           
            <?php
            if (!isset($_GET['page']))
                include 'marketing/index.php';
            elseif ($_GET['page'] == 'dynamic')
                include 'marketing/dynamic_schedule.php';
            elseif ($_GET['page'] == 'train')
                include 'marketing/train.php';
            elseif ($_GET['page'] == 'ads')
                include 'marketing/ads.php';
            elseif ($_GET['page'] == 'route')
                include 'marketing/route.php';
            elseif ($_GET['page'] == 'logout') {
                @session_destroy();
                echo "<script>alert('You are being logged out'); window.location='../';</script>";
                exit;
            }
            elseif ($_GET['page'] == 'search')
                include 'marketing/search.php';

            else {
                include 'marketing/index.php';
            }
            
            ?>
           
        </div>
       

      
        <aside class="control-sidebar control-sidebar-dark">
           
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        

         
        <footer class="main-footer">
           
            <div class="float-right d-none d-sm-inline">
                <?php echo SITE_NAME; ?>
            </div>
            
            <strong><?php echo date("Y"); ?> - All Rights Reserved</strong>
        </footer>
    </div>
     
    <script src="plugins/jquery/jquery.min.js"></script>
     
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
     
    <script src="dist/js/adminlte.min.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
     
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
   
    <script src="dist/js/demo.js"></script>
    <script src="dist/js/pages/dashboard3.js"></script>

    <script>
    $(function() {
        $("#example1").DataTable();
    });
    </script>
    <?php if (@$_GET['page'] == 'query') { ?>
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
 
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>

     
    <script>
    $(function() {
        

        $('.knob').knob({
            draw: function() {}
        })

    })
    </script>
    <?php } ?>

</body>

</html>