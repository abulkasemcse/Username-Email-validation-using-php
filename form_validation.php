<!DOCTYPE html>
<html>

<head>
    <title>Email & User Validation</title>
    <style type="text/css">
fieldset {
    font: 1em Verdana, Geneva, sans-serif;
    text-transform: none;
    color: whitesmoke;
    background: black;
    border: thin solid #333;
    }

    err {
        color: red;
    }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <fieldset>

    <?php
    error_reporting(0);
    session_start();

    //  $nameErr = $emailErr = "";

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $length = strlen($name);
        if (empty($name)) {
            $_SESSION['nameErr'] = "<b>Please!</b> Enter Your Name";
            $_SESSION['msg_typ'] = "danger";
            // $nameErr = "Name is required!";
        } else if (!preg_match("/^[a-z\s]*$/i", $name)) {
            $_SESSION['nameErr'] = "Only alphabet character are allowe";
            $_SESSION['msg_typ'] = "danger";
            // $nameErr = "Only alphabet character are allowed";
        } else if ($length < 4 || $length > 8) {
            $_SESSION['nameErr'] = "Username must be 4-8 characters";
            $_SESSION['msg_typ'] = "danger";
            // $nameErr = "Username must be within 8 characters";
        }

        if (empty($_POST['email'])) {
            $_SESSION['emailErr'] = "<b>Please!</b> Enter Your Email";
            $_SESSION['msg_typ'] = "danger";
            //  $emailErr = "Email is required!";
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['emailErr'] = "<b>Invalid!</b> Email Address!";
                $_SESSION['msg_typ'] = "danger";
                // $emailErr = "Invalid Email Address!";
            }
        }
        if (empty($_SESSION['nameErr']) && empty($_SESSION['emailErr'])) {

            $_SESSION['message'] = "<?>Great!</?> Successfuly Submited.";
            $_SESSION['msg_typ'] = "success";
        }
    }

    ?>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <div class="alert alert-<?= $_SESSION['msg_typ'] ?>">
            <?php
            echo $_SESSION['message'];
            session_unset()

            ?>
        </div>
    <?php }  ?>


    <div class="container">
        <h2> Type any Username and Email to Display Validation </h2>

        <!-- <span class="error">* Required Field</span> -->


        <div class="row">
            <div class="col-4">
                <form action="" method="POST">
                    <input type="text" class="form-control mt-5" placeholder="Enter Your Name" name="name" value="<?= $name;  ?>">
                    <span>&nbsp;</span>
                    <?php
                    if (isset($_SESSION['nameErr'])) {
                    ?>
                        <div class="alert alert-<?= $_SESSION['msg_typ'] ?>">
                            <?php
                            echo $_SESSION['nameErr'];
                            session_unset()

                            ?>
                        </div>
                    <?php }  ?>
                    <input type="text" class="form-control mt-3" placeholder="Enter Your Email" name="email" value="<?= $_POST['email'] ?>">
                    <span>&nbsp;</span>
                    <?php
                    if (isset($_SESSION['emailErr'])) { ?>
                        <div class="alert alert-<?= $_SESSION['msg_typ'] ?>">
                            <?php
                            echo $_SESSION['emailErr'];
                            session_unset()

                            ?>
                        </div>
                    <?php }  ?>


                    <button name="submit" value="submit" class="btn btn-danger mt-3">Submit</button>
                </form>
            </div>
        </div>
</body>

</html>
</fieldset>