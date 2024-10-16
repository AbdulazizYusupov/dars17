<?php
if (!isset($_SESSION['Auth']) || $_SESSION['Auth']->role != 'admin') {
  header('location: /login');
}
use App\Models\Task;
use App\Models\User;
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
      <img class="animation__shake" src="../../App/public/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
        width="60">
    </div>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="/login" class="nav-link active">
                Logout
              </a>
            </li>
          </ul>
        </nav>
    </aside>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div>
          </div>
        </div>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <?php
                    $count = count(Task::taskall(0));
                    ?>
                    <h3><?php echo $count; ?></h3>
                    <p>Given tasks <?php echo $count; ?></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="/admin?task1=0" class="small-box-footer">More info <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <?php
                    $count1 = count(Task::taskall(1));
                    ?>
                    <h3><?php echo $count1; ?><sup style="font-size: 20px"></sup></h3>

                    <p>Accepted tasks <?php echo $count1; ?> </p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="/admin?task2=1" class="small-box-footer">More info <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <?php
                    $count2 = count(Task::taskall(2));
                    ?>
                    <h3><?php echo $count2 ?></h3>

                    <p>Progress <?php echo $count2 ?></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="/admin?task3=2" class="small-box-footer">More info <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <?php
                    $count3 = count(Task::taskall(3));
                    ?>
                    <h3><?php echo $count3; ?></h3>
                    <p>Finished and waited tasks <?php echo $count3; ?></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/admin?task4=3" class="small-box-footer">More info <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
              <div class="col-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  AddTask
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Tasks</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="/task" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="title" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title"
                              required>
                          </div>
                          <div class="mb-3">
                            <label for="desc" class="form-label">Task Description</label>
                            <input type="text" class="form-control" id="desc" name="desc" required>
                          </div>
                          <div class="mb-3">
                            <label for="rasm" class="form-label">Task Image</label>
                            <input type="file" class="form-control" id="rasm" name="rasm" required>
                          </div>
                          <select class="form-select" aria-label="Default select example" name="user_id">
                            <?php

                            $users = User::all();
                            foreach ($users as $user) { ?>
                              <option selected value="<?= $user->id ?>"><?= $user->name ?></option>
                            <?php }
                            ?>
                          </select>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="ok">Add</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                  <tr>
                    <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">ID</th>
                    <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">Title</th>
                    <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">Description</th>
                    <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">Image</th>
                    <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">Users</th>
                    <th style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">Status</th>
                  </tr>
                  <?php
                  if (isset($_GET['task1'])) {
                    $tasks = Task::taskall(0);
                  } elseif (isset($_GET['task2'])) {
                    $tasks = Task::taskall(1);
                  } elseif (isset($_GET['task3'])) {
                    $tasks = Task::taskall(2);
                  } elseif (isset($_GET['task4'])) {
                    $tasks = Task::taskall(3);
                  } else {
                    $tasks = Task::taskall(0);
                  }
                  foreach ($tasks as $task) { ?>
                    <tr>
                      <td style="border: 1px solid black; padding: 10px;"><?= $task['id'] ?></td>
                      <td style="border: 1px solid black; padding: 10px;"><?= $task['title'] ?></td>
                      <td style="border: 1px solid black; padding: 10px;"><?= $task['description'] ?></td>
                      <td style="border: 1px solid black; padding: 10px;"><img src="<?php echo "img/" . $task['image'] ?>"
                          width="100px"></td>
                      <td style="border: 1px solid black; padding: 10px;"><?= $task['name'] ?></td>
                      <td style="border: 1px solid black; padding: 10px;">
                        <?php
                        $color = ($task['status'] == 0) ? '#2196F3' : (($task['status'] == 1) ? '#FFC107' : (($task['status'] == 2) ? '#4CAF50' : '#FF5722'));
                        ?>

                        <span style="
    background-color: <?php echo $color; ?>; /* Statusga qarab fon rangi */
    color: white; /* Oq rangli matn */
    padding: 5px 10px; /* Ichki chekka (padding) */
    border-radius: 5px; /* Burchaklarni yumaloqlash */
    text-align: center; /* Matnni markazlash */
    display: inline-block; /* Elementning tugma ko'rinishda bo'lishi uchun */
  ">
                          <?php
                          echo ($task['status'] == 0) ? 'Vazifa berilgan' : (($task['status'] == 1) ? 'Qabul qilingan' : (($task['status'] == 2) ? 'Topshirilgan' : 'Jarayonda'));
                          ?>
                        </span>
                      </td>
                    </tr>
                  <?php }
                  ?>
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
          <script src="../../App/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
          <!-- Summernote -->
          <script src="../../App/public/plugins/summernote/summernote-bs4.min.js"></script>
          <!-- overlayScrollbars -->
          <script src="../../App/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
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