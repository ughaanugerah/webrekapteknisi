<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style type="text/css">
.login-form {
  width: 340px;
  margin: 50px auto;
}
.login-form form {
  margin-bottom: 15px;
  background: #f7f7f7;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.login-form h2 {
  margin: 0 0 15px;
}
.form-control, .btn {
  min-height: 38px;
  border-radius: 2px;
}
.btn {
  font-size: 15px;
  font-weight: bold;
}
</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
</head>
<body>

  <?php

  include_once '../navbar.php';
  include '../function/function.php';
  include 'checkuser.php';

  if (isset($_SESSION['info'])) {
    echo "<div class='alert alert-primary text-ceter' role='alert'>";
    echo $_SESSION['info'];
    echo "</div>  }";
    unset($_SESSION['info']);
  }

  if (isset($_SESSION['user'])) {
    header('Location: /dashboard/index.php');
  }

  ?>

  <div class="login-form">
    <form method="post">
      <h2 class="text-center">Log in</h2>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" name="username" autofocus required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
      </div>
      <div class="form-group">
        <button type="submit" name="login" class="btn btn-primary btn-block">Log in</button>
      </div>
    </form>
  </div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
