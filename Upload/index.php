<?php
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
    <title>Post Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b311425060.js" crossorigin="anonymous"></script>
    <link href="style.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg mb-5" style="background-color: blueviolet;">
        <div class="container">
            <div class="navbar-nav me-auto pt-2 mb-lg-0 editing">
                <h5 class="text-light">Upload picture</h5>
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </div>
            <div class="float-end">
                <a href="../Home/index.php"><button class="btn-bd-primary change" type="submit">Back to home</button></a>
            </div>
        </div>
    </nav>
    <div class="container col-md-6 p-5" style="background-color: #fbfaff;">
        <img src="../image/image-up.jpg" class="img-fluid mb-2" alt="...">
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="" name="head" required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload image</label>
                <input class="form-control" type="file" id="formFile" name="image" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none;" name="disc" required></textarea>
            </div>
            <div class="d-grid gap-2 mt-5">
                <button class="btn-bd-primary" type="submit" name="upload">Upload</button>
            </div>
        </form>
        <?php
        if (isset($_POST['upload'])) {
            $head = $_POST['head'];

            $image = $_FILES['image']['name'];
            $tmp_img = $_FILES['image']['tmp_name'];

            move_uploaded_file($tmp_img, "../image/$image");

            $disc = htmlspecialchars($_POST['disc']);

            date_default_timezone_set("ASIA/KOLKATA");
            $date = date('d-m-y');
            $time = date('h:i a');

            $insert = "INSERT INTO `content`(`cont_id`, `cont_head`, `cont_image`, `cont_disc`, `cont_date`, `cont_time`) VALUES (NULL,'$head','$image','$disc','$date','$time')";
            $insert_query = mysqli_query($connect, $insert);

            if (!$insert_query) {
                echo '<div class="error mt-2">
                <h6 class="mt-2">Enter details in correct format</h6>
                </div>';
            } else {
                echo '<div class="green mt-2">
                <h6 class="mt-2">Successfully Uploaded!</h6>
                </div>';
            }
        }
        ?>
    </div>
    <nav class="bar pt-2 mt-5" style="background-color: #ece7ff;">
        <div class="container text-center">
            <p style="color: blueviolet;">Copyrights &copy; <?php echo date('Y') ?> . All rights reserved.</p>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        $("div.error").hide().slideDown(300);
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>