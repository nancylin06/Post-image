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
    <title>Send Email</title>
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
                        <img src="../image/email.jpg" class="img-fluid" alt="...">
                    </div>
                    <div class="card-body">
                        <h4 class="text-center">Enter your e-mail</h4>
                        <form action="index.php" method="POST" autocomplete="on">
                            <div class="mb-3">
                                <label for="mail">E-mail</label>
                                <input class="form-control" type="email" placeholder="" id="mail" name="email" required>
                            </div>
                            <div class="d-grid gap-2 mb-3">
                                <button class="btn-bd-primary" type="submit" name="send">Send OTP</button>
                            </div>
                        </form>
                        <?php

                        use PHPMailer\PHPMailer\PHPMailer;
                        use PHPMailer\PHPMailer\SMTP;
                        use PHPMailer\PHPMailer\Exception;

                        require '../mailer/src/Exception.php';
                        require '../mailer/src/PHPMailer.php';
                        require '../mailer/src/SMTP.php';
                        if (isset($_POST['send'])) {
                            $email = $_POST['email'];

                            $select_mail = "SELECT * FROM `user_info` WHERE `user_email` = '$email'";
                            $select_mail_query = mysqli_query($connect, $select_mail);

                            if (!$select_mail_query) {
                                echo '<div class="error mt-2">
                                <h6 class="mt-2">Enter your correct email address</h6>
                                </div>';
                            } else {
                                //Create an instance; passing `true` enables exceptions
                                $mail = new PHPMailer(true);

                                try {
                                    //Server settings
                                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                    $mail->Username   = 'nevilinxa@gmail.com';                     //SMTP username
                                    $mail->Password   = 'igtaheneodrcyorl';                               //SMTP password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                    //Recipients
                                    $mail->setFrom('nevilinxa@gmail.com', 'Admin');
                                    $mail->addAddress($email);     //Add a recipient

                                    $code = mt_rand(100000, 999999);

                                    //Content
                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = 'Password Reset';
                                    $mail->Body    = 'Your code is <b>' . $code . '</b><br>To reset password click <a href="http://localhost/post/Otp/index.php?code=' . $code . '">here</a>';
                                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                                    $update_code = "UPDATE `user_info` SET `user_code`='$code',`current_date` = current_date() WHERE `user_email` = '$email'";
                                    $update_code_query = mysqli_query($connect, $update_code);

                                    if ($update_code_query) {
                                        $mail->send();
                                        echo '<div class="green mt-2">
                                    <h6 class="mt-2">OTP has been send through your email</h6>
                                    </div>';
                                    }
                                } catch (Exception $e) {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
                            }
                        }
                        ?>
                        <p class="mt-2 text-center">Back to login? <a href="../Log in/index.php">click here</a></p>
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