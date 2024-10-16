<?php
if (isset($_SESSION['text'])) {
  echo $_SESSION['text'];
}
?>
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Register</p>

    <form action="/register" method="post">
      <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Name">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <button type="submit" name="ok" class="btn btn-primary btn-block">Sign Up</button>
        </div>
      </div>
    </form>

    <p class="mb-0">
      <a href="/login" class="text-center">Already have a membership</a>
    </p>
  </div>
  <!-- /.login-card-body -->
</div>