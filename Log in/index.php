<?php
ob_start();
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'post_image');
if (!$connect) {
  die('server not connected');
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/b311425060.js" crossorigin="anonymous"></script>
  <link href="style.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">
</head>

<body>
  <div class="container-md d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header" style="background-color: #bf99f2;">
            <img src="../image/puple.jpg" class="img-fluid" alt="...">
          </div>
          <div class="card-body">
            <h4 class="text-center">LOG IN</h4>
            <form action="index.php" method="POST" autocomplete="off">
              <div class="mb-3">
                <label for="mail">E-mail</label>
                <input class="form-control" type="email" placeholder="Enter your email" id="mail" name="email">
              </div>
              <div class="mb-4">
                <label for="pass">Password</label>
                <input class="form-control" type="password" placeholder="Enter your password" id="pass" name="passcode">
              </div>
              <div class="d-grid gap-2 mb-3">
                <button class="btn-bd-primary" type="submit" name="login">Log in</button>
              </div>
            </form>
            <?php
            if (isset($_POST['login'])) {
              $get_mail = $_POST['email'];
              $get_pass = $_POST['passcode'];

              if (!empty($get_mail) && !empty($get_pass)) {
                $select_login = "SELECT * FROM `user_info` WHERE `user_email` = '$get_mail'";
                $select_login_query = mysqli_query($connect, $select_login);

                while ($row = mysqli_fetch_assoc($select_login_query)) {
                  $log_id = $row['user_id'];
                  $log_name = $row['user_name'];
                  $log_email = $row['user_email'];
                  $log_pass = $row['user_pass'];
                  $log_profile = $row['user_profile'];
                  $log_gender = $row['user_gender'];
                }

                if (mysqli_num_rows($select_login_query) === 0) {
                  echo '<div class="error my-2">
                  <h6 class="pt-1">Your are not a member!<br>Click the below link to sign up</h6>
                  </div>';
                } else {
                  if ($get_mail === $log_email && $get_pass === $log_pass) {
                    header('location:../Home/index.php');
                    $_SESSION['user_name'] = $log_name;
                    $_SESSION['user_id'] = $log_id;
                  } else {
                    echo '<div class="error my-2">
                    <h6 class="pt-1">Password or email is incorrect</h6>
                    </div>';
                  }
                }
              } else {
                echo '<div class="error my-2">
                <h6 class="pt-1">Enter your email id and password</h6>
                </div>';
              }
            }
            ?>
            <p class="mt-1 text-center">Forgot password? <a href="../Email/index.php">click here</a></p>
            <p class="text-center">Create account <a href="../sign up/index.php">sign up</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>