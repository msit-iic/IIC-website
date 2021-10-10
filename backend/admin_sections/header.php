<?php 
    include_once("admin_sections/page-title.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?php 
            echo $title;
        ?>
    </title>

    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">

    <!-- Google Font: Source Sans Pro -->
    <!-- Custom CSS -->
    <!-- Font awewsome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Color Option -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
    <link href="assets/css/styles.css?v=<?php echo time(); ?>" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">


    <style>
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
        }

        .logo {
            max-width: 120px;
            position: relative;
            top: 4px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed red-skin">
    <div class="wrapper">

        <!--=========== Preloader ===================-->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img src="assets/img/preloading.gif" alt="Loading.... " height="60" width="60">
        </div>

        <!--================ Navbar =======================-->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!--============= Left navbar links ============ -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- ================ Right navbar links ==================== -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>


                <!-- =========== ---- Full Screen Option -----=============  -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <?php if (isset($_SESSION["id"])) { ?>
                    <li class="login_click" style="font-weight:700;background-color:aquamarine;padding:5px 3px;border-radius:8px;">
                        <a href="?process=logout" type="button">Logout</a>
                    </li>
                <?php } ?>

                <!-- ========----------- ========= Right SideBar Revealer ============= ----------------- = -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- ==========  /.navbar = ========== -->

        <!-- ==========  Left Sidebar Container ============== === -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="assets/img/logo.png" class="img-circle elevation-2" alt="IIC MSIT Logo">
                    </div>
                    <div class="info" style="color:#fff; font-weight:bolder;font-size:larger;">
                        IIC MSIT
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admins" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Manage Admin Profile
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="mailing-list" class="nav-link">
                                <i class="nav-icon fad fa-stream"></i>
                                <p>
                                    Mailing List
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="compose" class="nav-link">
                                <i class="nav-icon fad fa-paper-plane"></i>
                                <p>
                                    Compose Mails
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="blogs" class="nav-link">
                                <i class="nav-icon fad fa-blog"></i>
                                <p>
                                    Blogs
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>



        <section class="gray pt-0 fixing-top content-wrapper" style="min-height:auto">