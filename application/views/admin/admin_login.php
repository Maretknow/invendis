<div class="login-box-body">
    <p class="login-box-msg">Silahkan Login</p>

    <form action="<?php echo base_url('Login') ?>" method="post">
      <div class="form-group has-feedback">
        <input name="username_admin" type="text" class="form-control" placeholder="Masukan Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password_admin" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>