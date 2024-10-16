<?php
if (!isset($_SESSION['Auth']) || $_SESSION['Auth']->role != 'user') {
    header('location: /login');
}
use App\Models\Task;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UserLTE 3</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../App/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../../App/public/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../App/public/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../App/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/user" class="brand-link">
                <img src="../../App/public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">UserLTE 3</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../App/public/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="/user" class="d-block">User</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="/user" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Tasks
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/login" class="nav-link active">
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper kanban">
            <section class="content p-5">
                <div class="container h-100">
                    <div class="card card-row card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Tasks
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM tasks WHERE status = 0";
                            $tasks = Task::query($sql);

                            foreach ($tasks as $task) { ?>
                                <form action="" method="GET">
                                    <input type="hidden" name="id" value="<?= $task->id ?>">
                                    <div class="card" style="width: 15rem;">
                                        <img src="../../img/<?= $task->image ?>" class="card-img-top" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $task->title ?></h5>
                                            <p class="card-text"><?= $task->description ?></p>
                                            <button name="nol" class="btn btn-primary">Go start</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            } ?>
                        </div>
                    </div>
                    <div class="card card-row card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Start
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['nol']) && isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $sql = "UPDATE tasks SET status = 1 WHERE id = $id";
                                Task::query($sql);
                            }
                            $sql = "SELECT * FROM tasks WHERE status = 1";
                            $tasks = Task::query($sql);
                            foreach ($tasks as $task) { ?>
                                <form action="" method="GET">
                                    <input type="hidden" name="id" value="<?= $task->id ?>">
                                    <div class="card" style="width: 15rem;">
                                        <img src="../../img/<?= $task->image ?>" class="card-img-top" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $task->title ?></h5><br>
                                            <p class="card-text"><?= $task->description ?></p>
                                            <button name="one" class="btn btn-primary">Go progress</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            } ?>
                        </div>
                    </div>
                    <div class="card card-row card-default">
                        <div class="card-header bg-info">
                            <h3 class="card-title">
                                In Progress
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['one']) && isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $sql = "UPDATE tasks SET status = 2 WHERE id = $id";
                                Task::query($sql);
                            }
                            $sql = "SELECT * FROM tasks WHERE status = 2";
                            $tasks = Task::query($sql);
                            foreach ($tasks as $task) { ?>
                                <form action="" method="GET">
                                    <input type="hidden" name="id" value="<?= $task->id ?>">
                                    <div class="card" style="width: 15rem;">
                                        <img src="../../img/<?= $task->image ?>" class="card-img-top" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $task->title ?></h5><br>
                                            <p class="card-text"><?= $task->description ?></p>
                                            <button name="two" class="btn btn-primary">Go done</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            } ?>
                        </div>
                    </div>
                    <div class="card card-row card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                Done
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php

                            if (isset($_GET['two']) && isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $sql = "UPDATE tasks SET status = 3 WHERE id = $id";
                                Task::query($sql);
                            }
                            $sql = "SELECT * FROM tasks WHERE status = 3";
                            $tasks = Task::query($sql);

                            foreach ($tasks as $task) { ?>
                                <div class="card" style="width: 15rem;">
                                    <img src="../../img/<?= $task->image ?>" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $task->title ?></h5><br>
                                        <p class="card-text"><?= $task->description ?></p>
                                    </div>
                                </div>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <!-- jQuery -->
    <script src="../../App/public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../App/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="../../App/public/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../App/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../App/public/dist/js/adminlte.min.js"></script>
    <!-- Filterizr-->
    <script src="../../App/public/plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../App/public/dist/js/demo.js"></script>
    <!-- Page specific script -->
</body>

</html>