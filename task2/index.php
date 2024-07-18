<?php
  session_start();
  if(isset($_SESSION['username'])){
    header("location:profile.php");
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure User Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style type="text/css">
        #alert,
        #register-box,
        #forgot-box, #loader{
            display: none;
        }
    </style>
</head>

<body class="bg-dark">
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-4 mx-auto" id="alert">
            <div class="alert alert-success">
                <strong id="result">Hello World!</strong>
            </div>
        </div>
    </div>
    <div class="text-center">
        <img src="Hourglass.gif" width="55px" height="50px" class="m-2" id="loader">
    </div>

    <div class="row">
        <div class="col-lg-4 mx-auto bg-light rounded" id="login-box">
            <h2 class="text-center mt-2">Login</h2>
            <form action="" method="post" role="form" class="p-2" id="login-frm">
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required minlength="3" value="<?php if(isset($_COOKIE['username'])) {echo $_COOKIE['username']; } ?>">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required minlength="6" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password']; } ?>">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="rem" id="customCheck" class="form-check-input" <?php if(isset($_COOKIE['username'])) { ?> checked <?php } ?>>
                    <label for="customCheck" class="form-check-label">Remember Me</label>
                    <a href="#" id="forgot_btn" class="float-end">Forgot Password ?</a>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Login" id="login" name="login" class="btn btn-primary btn-block">
                </div>
                <div class="mb-3 text-center">
                    <p>New User ? <a href="#" id="register-btn">Register Here</a></p>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mx-auto bg-light rounded" id="register-box">
            <h2 class="text-center mt-2">Register</h2>
            <form action="" method="post" role="form" class="p-2" id="register-frm">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required minlength="5">
                </div>
                <div class="mb-3">
                    <input type="text" name="uname" class="form-control" placeholder="Username" required minlength="3">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required minlength="6">
                </div>
                <div class="mb-3">
                    <input type="password" name="cpass" id="cpass" class="form-control" placeholder="Confirm Password" required minlength="6">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="rem" id="customCheck2" class="form-check-input">
                    <label for="customCheck2" class="form-check-label">I agree to the <a href="#">terms & conditions</a></label>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Register" id="register" name="register" class="btn btn-primary btn-block">
                </div>
                <div class="mb-3 text-center">
                    <p>Returning User ? <a href="#" id="login-btn">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mx-auto bg-light rounded" id="forgot-box">
            <h2 class="text-center mt-2">Reset Password</h2>
            <form action="" method="post" role="form" class="p-2" id="forgot-frm">
                <div class="mb-3">
                    <small class="text-muted">
                        To reset the password, enter your email address and we will send the reset password instructions on your email.
                    </small>
                </div>
                <div class="mb-3">
                    <input type="email" name="femail" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Reset" id="forgot" name="forgot" class="btn btn-primary btn-block">
                </div>
                <div class="mb-3 text-center">
                    <a href="#" id="back-btn">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"
        integrity="sha512-O/nUTF5mdFkhEoQHFn9N5wmgYyW323JO6v8kr6ltSRKriZyTr/8417taVWeabVS4iONGk2V444QD0P2cwhuTkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#register-btn").click(function () {
                $("#register-box").show();
                $("#login-box").hide();
                $("#forgot-box").hide();
            });
            $("#login-btn").click(function () {
                $("#login-box").show();
                $("#register-box").hide();
                $("#forgot-box").hide();
            });
            $("#forgot_btn").click(function () {
                $("#forgot-box").show();
                $("#login-box").hide();
                $("#register-box").hide();
            });
            $("#back-btn").click(function () {
                $("#login-box").show();
                $("#forgot-box").hide();
                $("#register-box").hide();
            });
            $("#login-frm").validate();
            $("#register-frm").validate({
                rules:{
                    cpass:{
                        equalTo:"#pass",
                    }
                }
            })
            $("#forgot-frm").validate();

            // submit form without page refresh

            $("#register").click(function(e){
                if(document.getElementById('register-frm').checkValidity()){
                    e.preventDefault();
                    $("#loader").show();
                    $.ajax({
                        url:'action.php',
                        method:'post',
                        data:$("#register-frm").serialize()+'&action=register',
                        success:function(response){
                            $("#alert").show();
                            $("#result").html(response);
                            $("#loader").hide();
                        }
                    });
                }
                return true;
            });

            $("#login").click(function(e){
                if(document.getElementById('login-frm').checkValidity()){
                    e.preventDefault();
                    $("#loader").show();
                    $.ajax({
                        url:'action.php',
                        method:'post',
                        data:$("#login-frm").serialize()+'&action=login',
                        success:function(response){
                            if(response==="ok"){
                                window.location='profile.php';
                            }else{
                            $("#alert").show();
                            $("#result").html(response);
                            $("#loader").hide();
                            }
                        }
                    });
                }
                return true;
            });

            $("#forgot").click(function(e){
                if(document.getElementById('forgot-frm').checkValidity()){
                    e.preventDefault();
                    $("#loader").show();
                    $.ajax({
                        url:'action.php',
                        method:'post',
                        data:$("#forgot-frm").serialize()+'&action=forgot',
                        success:function(response){
                            $("#alert").show();
                            $("#result").html(response);
                            $("#loader").hide();
                        }
                    });
                }
                return true;
            });
        });
    </script>

</body>

</html>