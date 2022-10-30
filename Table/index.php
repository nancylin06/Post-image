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
    <title>Post details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b311425060.js" crossorigin="anonymous"></script>
    <link href="style.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg mb-5" style="background-color: blueviolet;">
        <div class="container">
            <div class="navbar-nav me-auto pt-2 mb-lg-0 text-light">
                <h5>Post Details</h5>
            </div>
            <div class="float-end">
                <a href="../Home/index.php">
                    <button class="btn-bd-primary change" type="submit">Back to home</button>
                </a>
            </div>
        </div>
    </nav>
    <div class="container table-responsive mb-5">
        <table class="table table-hover table-bordered">
            <thead>
                <tr style="background-color: #bf99f2;" class="text-center text-light">
                    <th scope="col">Heading</th>
                    <th scope="col">Image</th>
                    <th scope="col">Content</th>
                    <th scope="col" class="text-center">Date</th>
                    <th scope="col" class="text-center">Time</th>
                    <th scope="col" class="text-center">Edit</th>
                    <th scope="col" class="text-center">Delete</th>
                </tr>
            </thead>
            <?php
            $select = "SELECT * FROM `content`";
            $select_query = mysqli_query($connect, $select);

            while ($row = mysqli_fetch_assoc($select_query)) {
                $id = $row['cont_id'];
                $heading = $row['cont_head'];
                $mage = $row['cont_image'];
                $discrip = $row['cont_disc'];
                if(str_word_count($discrip) > 10){
                    $final_disc =  implode(' ', array_slice(explode(' ', $discrip), 0, 10)) . "...";
                }else{
                    $final_disc = $discrip;
                }
                $dat = $row['cont_date'];
                $tim = $row['cont_time'];
            ?>
                <tbody>
                    <tr>
                        <th scope="row" class="text-center align-middle"><?php echo $heading; ?></th>
                        <td><img src="../image/<?php echo $mage; ?>" width="100" class="img-fluid m-auto d-block" alt="..."></td>
                        <td class="col-4"><?php echo $final_disc; ?></td>
                        <td class="align-middle text-center"><?php echo $dat; ?></td>
                        <td class="align-middle text-center"><?php echo $tim; ?></td>
                        <td class="align-middle text-center blue"><a href="../Edit/index.php?edit=<?php echo $id; ?>"><i class="fa-regular fa-pen-to-square"></i></a></td>
                        <td class="align-middle text-center red"><a href="index.php?delete=<?php echo $id ?>"><i class="fa-regular fa-trash-can"></i></a></td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
        <?php
        if (isset($_GET['delete'])) {
            $del = $_GET['delete'];
            $delete = "DELETE FROM `content` WHERE `cont_id` = '$del'";
            $delete_query = mysqli_query($connect, $delete);

            header("location:index.php");
        }
        ?>
    </div>
    <nav class="bar pt-2 mt-5" style="background-color: #ece7ff;">
        <div class="container text-center">
            <p style="color: blueviolet;">Copyrights &copy; <?php echo date('Y') ?> . All rights reserved.</p>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>