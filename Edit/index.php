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
    <title>Edit post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b311425060.js" crossorigin="anonymous"></script>
    <link href="style.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg mb-5" style="background-color: blueviolet;">
        <div class="container">
            <div class="navbar-nav me-auto pt-2 mb-lg-0 editing">
                <h5 class="text-light">Edit Post</h5>
                <i class="fa-regular fa-pen-to-square"></i>
            </div>
            <div class="float-end">
                <a href="../Table/index.php"><button class="btn-bd-primary change" type="submit">Go back</button></a>
            </div>
        </div>
    </nav>
    <div class="container col-md-6 p-5" style="background-color: #fbfaff;">
        <img src="../image/concept-image.jpg" class="img-fluid mb-2" alt="...">
        <?php
        if (isset($_GET['edit'])) {
            $edit = $_GET['edit'];

            $select = "SELECT * FROM `content` WHERE `cont_id` = '$edit'";
            $select_query = mysqli_query($connect, $select);

            while ($row = mysqli_fetch_assoc($select_query)) {
                $value = $row['cont_id'];
                $title = $row['cont_head'];
                $image = $row['cont_image'];
                $coment = $row['cont_disc'];
        ?>
                <form action="index.php?edit=<?php echo $edit; ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Post Title</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="" value="<?php echo $title; ?>" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Change image</label>
                        <img src="../image/<?php echo $image; ?>" width="100" class="img-thumbnail m-2" alt="...">
                        <input class="form-control" type="file" id="formFile" name="pic">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none;" name="area" required><?php echo $coment; ?></textarea>
                    </div>
                    <div class="d-grid gap-2 mt-5">
                        <button class="btn-bd-primary" type="submit" name="update">Update</button>
                    </div>
                </form>
        <?php }
        }
        if (isset($_POST['update'])) {
            if (isset($_GET['edit'])) {
                $val = $_GET['edit'];

                $head = $_POST['title'];
                $pic = $_FILES['pic']['name'];
                $pic_tmp = $_FILES['pic']['tmp_name'];
                move_uploaded_file($pic_tmp, "../image/$pic");
                $area = htmlspecialchars($_POST['area']);
                date_default_timezone_set("ASIA/KOLKATA");
                $day = date("d-m-y");
                $time = date('h:i a');

                if (empty($pic)) {
                    $mage = "SELECT * FROM `content` WHERE `cont_id` = '$val'";
                    $mage_query = mysqli_query($connect, $mage);

                    while ($row = mysqli_fetch_assoc($mage_query)) {
                        $pic = $row['cont_image'];
                    }
                }

                $update = "UPDATE `content` SET `cont_head`='$head',`cont_image`='$pic',`cont_disc`='$area',`cont_date`='$day',`cont_time`='$time' WHERE `cont_id` = '$val'";
                $update_query = mysqli_query($connect, $update);

                if (!$update_query) {
                    echo '<div class="error mt-2">
                    <h6 class="mt-2">Not updated</h6>
                    </div>';
                } else {
                    echo '<div class="green mt-2">
                    <h6 class="mt-2">Successfully Updated!</h6>
                    </div>';
                }
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