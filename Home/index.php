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
    <title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b311425060.js" crossorigin="anonymous"></script>
    <link href="style.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: blueviolet;">
        <div class="container col-md-11">
            <div class="profile mb-2 mb-md-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <?php
                if (isset($_SESSION['user_id'])) {
                    $name = $_SESSION['user_name'];
                    $id = $_SESSION['user_id'];

                    $select_profile = "SELECT * FROM `user_info` WHERE `user_id` = '$id'";
                    $select_profile_query = mysqli_query($connect, $select_profile);

                    while ($row = mysqli_fetch_assoc($select_profile_query)) {
                        $profile = $row['user_profile'];
                        $final_name = $row['user_name'];
                    }
                    if (empty($profile)) {
                        $profile = "images.jpg";
                    }
                    echo "<img src='../image/{$profile}' width='40' class='img-thumbnail' alt='...'>";
                }
                ?>
            </div>
            <div class="navbar-nav me-auto ms-3 pt-2 mb-lg-0 text-light">
                <?php echo '<h5>Hi, ' . ucfirst($final_name) . '</h5>'; ?>
            </div>
            <div class="float-end">
                <a href="../Table/index.php"><button class="btn-bd-primary change me-1" type="submit">View all post</button></a>
            </div>
        </div>
    </nav>
    <div class="container col-md-6 mt-3">
        <div class="row navbar">
            <div class="col-md-9 col-7">
                <h3 class="mt-2" style="color: blueviolet; font-weight:600;">POST</h3>
            </div>
            <div class="col-md-3 col-5">
                <a href="../Upload/index.php">
                    <button class="btn-bd-primary" type="submit">Upload Post<i class="fa-solid fa-arrow-up-from-bracket mx-2" style="color: #fbfaff;"></i></button>
                </a>
            </div>
        </div>
    </div>
    <?php
    $sell = "SELECT * FROM `content`";
    $sell_query = mysqli_query($connect, $sell);

    while ($row = mysqli_fetch_assoc($sell_query)) {
        $cont_id = $row['cont_id'];
        $cont_head = $row['cont_head'];
        $cont_image = $row['cont_image'];
        $cont_disc = $row['cont_disc'];
        $cont_date = $row['cont_date'];
        $cont_time = $row['cont_time'];
    ?>
        <div class="container col-md-6 mt-4">
            <div class="card mb-3">
                <div class="card-header" style="background-color: #bf99f2;">
                    <img src="../image/<?php echo $cont_image; ?>" width="200" class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $cont_head; ?></h5>
                    <p class="card-text"><?php echo $cont_disc ?></p>
                </div>
                <div class="card-footer" style="background-color: #fbfaff;">
                    <div class="left">
                        <i class="fa-regular fa-calendar me-1"></i>
                        <small class="text-dark"><?php echo $cont_date; ?></small>
                    </div>
                    <div class="right">
                        <i class="fa-regular fa-clock me-1"></i>
                        <small class="text-dark"><?php echo $cont_time; ?></small>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <nav class="bar pt-2 mt-5" style="background-color: #ece7ff;">
        <div class="container text-center">
            <p style="color: blueviolet;">Copyrights &copy; 2022. All rights reserved.</p>
        </div>
    </nav>
    <!-- offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header" style="background-color: #bf99f2;">
            <div class="profile">
                <?php echo "<img src='../image/{$profile}' width='40' class='img-thumbnail' alt='...'>"; ?>
            </div>
            <div class="offcanvas-title pt-2 mb-lg-0 text-light" id="offcanvasExampleLabel">
                <?php echo '<h5>Hi, ' . ucfirst($final_name) . '</h5>'; ?>
            </div>
            <button type="button" class="btn-close bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>A sample website to upload pictures. Core PHP concepts is used in this website.</p>
            <div class="d-grid gap-2 bts">
                <a href="../Profile/index.php"><button class="btn-bd-primary edit long" type="button">Edit Profile</button></a>
                <a href="../Log out/index.php"><button class="btn-bd-primary edit long" type="button">Log Out</button></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>