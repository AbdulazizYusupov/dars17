<?php
if (!isset($_SESSION['Auth']) || $_SESSION['Auth']->role != 'admin') {
    header('location: /');
}
use App\Models\User;

$users = User::all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../App/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="../../App/public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../App/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../App/public/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../App/public/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../App/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../App/public/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../App/public/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../App/public/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/user" class="brand-link">
                <img src="../../App/public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE </span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../App/public/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="/admin" class="d-block">Admin</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/admin" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Tasks
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/users" class="nav-link">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Users panel</h1>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                                    <tr>
                                        <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">
                                            ID</th>
                                        <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">
                                            Name</th>
                                        <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">
                                            Email</th>
                                        <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">
                                            Password</th>
                                        <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">
                                            Role</th>
                                        <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">
                                            Status</th>
                                    </tr>
                                    <?php foreach ($users as $user) {
                                        if ($user->name != $_SESSION['Auth']->name) { ?>
                                            <tr>
                                                <th style="border: 1px solid black; padding: 10px;"><?= $user->id ?></th>
                                                <td style="border: 1px solid black; padding: 10px;"><?= $user->name ?></td>
                                                <td style="border: 1px solid black; padding: 10px;"><?= $user->email ?></td>
                                                <td style="border: 1px solid black; padding: 10px;"><?= $user->password ?></td>
                                                <td style="border: 1px solid black; padding: 10px;"><?= $user->role ?></td>
                                                <td style="border: 1px solid black; padding: 10px;">

                                                    <?php if ($user->status == 1) { ?>
                                                        <form action="/status" method="POST">
                                                            <input type="hidden" value="<?= $user->id ?>" name="id">
                                                            <input type="submit" value="true" name="true" class="btn btn-success">
                                                        </form>
                                                    <?php } else { ?>
                                                        <form action="/status" method="POST">
                                                            <input type="hidden" name="id" value="<?= $user->id ?>">
                                                            <input type="submit" value="false" name="false" class="btn btn-danger">
                                                        </form>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                </table>
                            </div>
                        </div>
                        <aside class="control-sidebar control-sidebar-dark">
                        </aside>
                    </div>

                    <!-- jQuery -->
                    <script src="../../App/public/plugins/jquery/jquery.min.js"></script>
                    <!-- jQuery UI 1.11.4 -->
                    <script src="../../App/public/plugins/jquery-ui/jquery-ui.min.js"></script>
                    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
                    <script>
                        $.widget.bridge('uibutton', $.ui.button)
                    </script>
                    <!-- Bootstrap 4 -->
                    <script src="../../App/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <!-- ChartJS -->
                    <script src="../../App/public/plugins/chart.js/Chart.min.js"></script>
                    <!-- Sparkline -->
                    <script src="../../App/public/plugins/sparklines/sparkline.js"></script>
                    <!-- JQVMap -->
                    <script src="../../App/public/plugins/jqvmap/jquery.vmap.min.js"></script>
                    <script src="../../App/public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
                    <!-- jQuery Knob Chart -->
                    <script src="../../App/public/plugins/jquery-knob/jquery.knob.min.js"></script>
                    <!-- daterangepicker -->
                    <script src="../../App/public/plugins/moment/moment.min.js"></script>
                    <script src="../../App/public/plugins/daterangepicker/daterangepicker.js"></script>
                    <!-- Tempusdominus Bootstrap 4 -->
                    <script
                        src="../../App/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
                    <!-- Summernote -->
                    <script src="../../App/public/plugins/summernote/summernote-bs4.min.js"></script>
                    <!-- overlayScrollbars -->
                    <script
                        src="../../App/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
                    <!-- AdminLTE App -->
                    <script src="../../App/public/dist/js/adminlte.js"></script>
                    <!-- AdminLTE for demo purposes -->
                    <script src="../../App/public/dist/js/demo.js"></script>
                    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
                    <script src="../../App/public/dist/js/pages/dashboard.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                        crossorigin="anonymous"></script>
</body>

</html>