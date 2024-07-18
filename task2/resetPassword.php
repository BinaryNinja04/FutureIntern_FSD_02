<?php

require 'config.php';
$msg = "";
if (isset($_GET['email']) && isset($_GET['token'])) {

    $email = $_GET['email'];
    $token = $_GET['token'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE email=? AND token=? AND token<> '' AND tokenExpire>NOW()");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if (isset($_POST['submit'])) {
            $newpass = sha1($_POST['newpass']);
            $cnewpass = sha1($_POST['cnewpass']);

            if ($newpass == $cnewpass) {
                $stmt_u = $conn->prepare("UPDATE users SET token='', pass=? WHERE email=?");
                $stmt_u->bind_param("ss", $newpass, $email);
                $stmt_u->execute();

                $msg = "Password changed successfully!<br><a href='index.php'>Login Here</a>";
            } else {
                $msg = "Password did not match";
            }
        }
    } else {
        header("location:index.php");
        exit();
    }

} else {
    header("location:index.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 mt-5">
                <h3 class="text-center bg-dark text-light p-2 rounded">Reset Your Password Here !!</h3>
                <h4 class="text-success text-center"><?= $msg; ?></h4>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="password"> Enter New Password</label>
                        <input type="password" name="newpass" class="form-control" placeholder="New Password" required>
                    </div>
                    <div class="form-group">
                        <label for="password"> Confirm New Password</label>
                        <input type="password" name="cnewpass" class="form-control" placeholder="Confirm Password"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-success btn-block" value="Reset Password">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>