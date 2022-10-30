<?php
ob_start();
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
    <title>Enter Otp</title>
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
                        <h4 class="text-center my-3">One Time Password</h4>
                        <form action="index.php" method="POST" autocomplete="off">
                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" id="floatingInput" maxlength="6" placeholder="Enter your OTP" name="newCode">
                                <label for="floatingInput">Enter your OTP</label>
                            </div>
                            <div class="d-grid gap-2 mb-4">
                                <button class="btn-bd-primary" type="submit" name="enter">Submit</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['enter'])) {
                            $new_code = $_POST['newCode'];
                            //select data from database for otp validation
                            $select = "SELECT * FROM `user_info` WHERE `user_code` = '$new_code' AND `current_date` >= NOW() - Interval 1 DAY";
                            $select_query = mysqli_query($connect, $select);

                            if (mysqli_num_rows($select_query) < 1) {
                                echo '<div class="error">
                                    <h6 class="mt-2">Enter a valid OTP</h6>
                                    </div>';
                            } else {
                                while ($row = mysqli_fetch_assoc($select_query)) {
                                    $data_code = $row['user_code'];
                                }
                                if ($data_code === $new_code) {
                                    header('location:../New password/index.php?code=' . $new_code);
                                }
                            }
                        }
                        ?>
                        <!-- <p class="mt-1 text-center"><a href="../Log in/index.php">Resend OTP</a></p> -->
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