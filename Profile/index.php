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
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b311425060.js" crossorigin="anonymous"></script>
    <link href="style.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: blueviolet;">
        <div class="container">
            <div class="navbar-nav me-auto pt-2 mb-lg-0 editing">
                <h5 class="text-light">Edit profile</h5>
                <i class="fa-solid fa-user-pen"></i>
            </div>
            <div class="float-end">
                <a href="../Home/index.php"><button class="btn-bd-primary change" type="submit">Back to home</button></a>
            </div>
        </div>
    </nav>
    <div class="container col-md-6 p-5" style="background-color: #fbfaff;">
        <?php
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];

            $select_image = "SELECT * FROM `user_info` WHERE `user_id` = '$id'";
            $select_image_query = mysqli_query($connect, $select_image);

            while ($row = mysqli_fetch_assoc($select_image_query)) {
                $profile = $row['user_profile'];
                $taken_email = $row['user_email'];
            }
            if (empty($profile)) {
                $profile = "images.jpg";
            }
            echo "<img src='../image/{$profile}' width='100' class='img-thumbnail d-block mx-auto' alt='...'>";
        }
        ?>
        <div class="col-md-9 container">
            <?php
            $showName = $showMail = $showPass = "";

            if (isset($_POST['update'])) {
                $name = $_POST['name'];
                $main_image = $_FILES['picture']['name'];
                $tmp_image = $_FILES['picture']['tmp_name'];
                move_uploaded_file($tmp_image, "../image/$main_image");
                $email = $_POST['email'];
                $radio = $_POST['inlineRadioOptions'];
                $password = $_POST['password'];
                //reupload same profile picture
                if (empty($main_image)) {
                    $main_image = $profile;
                }
                //name validate
                if (empty($name)) {
                    $showName = "* This field is required";
                } else {
                    $pattern = "/^[a-zA-Z\\s]+$/";
                    $check = preg_match_all($pattern, $name);
                    if (!$check) {
                        $showName = "* Enter name in charecters";
                    }
                }
                //email validate
                if (empty($email)) {
                    $email = $taken_email;
                } else {
                    $checkMail = filter_var($email, FILTER_VALIDATE_EMAIL);
                    if (!$checkMail) {
                        $showMail = "* Enter a valid email";
                    }
                    //same email is not valid
                    $similar = "SELECT * FROM `user_info` WHERE `user_email` = '$email'";
                    $similar_query = mysqli_query($connect, $similar);
                    while ($row = mysqli_fetch_assoc($similar_query)) {
                        $same_mail = $row['user_email'];
                    }
                    if (mysqli_num_rows($similar_query) === 0) {
                        $showMail = "";
                    } else {
                        if ($email === $same_mail) {
                            $showMail = "* This email address is already taken";
                        }
                    }
                }
                //password validate
                if (empty($password)) {
                    $showPass = "* This field is required";
                } else {
                    $passPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,10}$/";
                    $checking = preg_match_all($passPattern, $password);
                    if (!$checking) {
                        $showPass = "* Password is not strong";
                    }
                }
                //Updating profile
                if (empty($showName) && empty($showMail) && empty($showPass)) {
                    $update_profile = "UPDATE `user_info` SET `user_name`='$name',`user_email`='$email',`user_pass`='$password',`user_profile`='$main_image',`user_gender`='$radio' WHERE `user_id` = '$id'";
                    $update_profile_query = mysqli_query($connect, $update_profile);
                }
            }
            //fetching data from mysql for input value
            if (isset($_SESSION['user_id'])) {
                $select_profile = "SELECT * FROM `user_info` WHERE `user_id` = '$id'";
                $select_profile_query = mysqli_query($connect, $select_profile);
                while ($row = mysqli_fetch_assoc($select_profile_query)) {
                    $get_name = $row['user_name'];
                    $got_email = $row['user_email'];
                    $got_pass = $row['user_pass'];
                    $got_gender = $row['user_gender'];
            ?>
                    <form action="index.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="" name="name" value="<?php echo $get_name; ?>">
                            <span class="error-message"><?php echo $showName; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Profile picture</label>
                            <input class="form-control" type="file" id="formFile" name="picture">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address <span style="background-color: #ece7ff;"><?php echo $got_email; ?></span></label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="">
                            <span class="error-message"><?php echo $showMail; ?></span>
                        </div>
                        <label class="mb-2">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="M" <?php echo ($got_gender == 'M') ? "checked" : ""; ?>>
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="F" <?php echo ($got_gender == 'F') ? "checked" : ""; ?>>
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $got_pass; ?>">
                            <span class="error-message"><?php echo $showPass; ?></span>
                        </div>
                        <div class="d-grid gap-2 mt-5">
                            <button class="btn-bd-primary" type="submit" name="update">Save changes</button>
                        </div>
                    </form>
            <?php }
                if (isset($_POST['update'])) {
                    if (empty($showName) && empty($showMail) && empty($showPass)) {
                        if ($update_profile_query) {
                            echo '<div class="green mt-2">
                              <h6 class="mt-2">Successfully Updated!</h6>
                              </div>';
                        }
                    }
                }
            } ?>
        </div>
    </div>
    <nav class="bar pt-2" style="background-color: #ece7ff;">
        <div class="container text-center">
            <p style="color: blueviolet;">Copyrights &copy; <?php echo date('Y') ?> . All rights reserved.</p>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>