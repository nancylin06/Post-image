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
    <title>Back to log in</title>
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
                        <div class="green my-3">
                            <h6>Password has been changed successfully!<br>Log in again</h6>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <a href="../Log in/index.php"><button class="btn-bd-primary" type="submit" name="change">Log in</button></a>
                        </div>
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