<?php
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
    <title>New password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b311425060.js" crossorigin="anonymous"></script>
    <link href="style.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">
</head>

<body>
    <div class="container-md d-flex justify-content-center align-items-center">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center my-3">Change password</h4>
                        <?php
                        if (isset($_GET['code'])) {
                            $code = $_GET['code'];
                        }
                        $showPassword = $showConfirm = "";
                        if (isset($_POST['change'])) {
                            $passcode = $_POST['passcode'];
                            $confirm = $_POST['confirm'];

                            //validate password
                            if (empty($passcode)) {
                                $showPassword = "* This field is required";
                            } else {
                                $passPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,10}$/";
                                $checking = preg_match_all($passPattern, $passcode);
                                if (!$checking) {
                                    $showPassword = "* Password is not strong";
                                }
                            }

                            //validate confirm password
                            if (empty($confirm)) {
                                $showConfirm = "* This field is required";
                            } else {
                                $confPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,10}$/";
                                $checked = preg_match_all($confPattern, $confirm);
                                if (!$checked) {
                                    $showConfirm = "* Password is not strong";
                                }
                            }

                            if ($passcode !== $confirm) {
                                $showConfirm = "* Password does not match";
                            }

                            if (empty($showPassword) && empty($showConfirm)) {
                                $update_password = "UPDATE `user_info` SET `user_pass`='$passcode' WHERE `user_code` = '$code'";
                                $update_password_query = mysqli_query($connect, $update_password);

                                if ($update_password_query) {
                                    header('location:../Back/index.php');
                                }
                            }
                        }
                        ?>
                        <form action="" method="POST" autocomplete="off">
                            <div class="mb-3">
                                <label for="pass">New password</label>
                                <input class="form-control" type="password" placeholder="" id="pass" name="passcode">
                                <span class="error-message"><?php echo $showPassword; ?></span>
                            </div>
                            <div class="mb-4">
                                <label for="password">Confirm password</label>
                                <input class="form-control" type="password" placeholder="" id="password" name="confirm">
                                <span class="error-message"><?php echo $showConfirm; ?></span>
                            </div>
                            <div class="d-grid gap-2 mb-3">
                                <button class="btn-bd-primary" type="submit" name="change">Confirm</button>
                            </div>
                        </form>
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