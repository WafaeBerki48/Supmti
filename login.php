<?php 
    $pageTitle="Login";
    include('includes/header.php');
    // require 'admin/function.php';
    require_once 'admin/config.php';

    $message = '';

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location:index.php');
        exit;
    }

    if (isset($_SESSION['admin_id'])) {
        header('Location: admin/index.php');
        exit;
    }

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($connexion, $_POST['email']);
        $password = mysqli_real_escape_string($connexion, md5($_POST['password']));

        $select_user = mysqli_query($connexion, "SELECT * FROM `user_form` WHERE `email` = '$email' AND password = '$password'");
        if (mysqli_num_rows($select_user) > 0) {
            $row = mysqli_fetch_assoc($select_user);
            $_SESSION['user_id'] = $row['id'];
            header('Location:index.php');
            exit;
        } 
        $select_admin = mysqli_query($connexion, "SELECT * FROM `admins` WHERE `email` = '$email' AND password = '$password'");
        if (mysqli_num_rows($select_admin) > 0) {
            $row = mysqli_fetch_assoc($select_admin);
            $_SESSION['admin_id'] = $row['id'];
            header('Location: admin/index.php');
            exit;
        } 
        else {
            $message = 'Incorrect email or password!';
        }
    }
?>
<style> 
   #sup{
      color: green;
   }
   #mti{
      color: red;
   }
   .message{
    margin:10px 0;
    width: 100%;
    border-radius: 5px;
    padding:10px;
    text-align: center;
    background-color: var(--red);
    color:var(--white);
    font-size: 20px;
    }

    .container1{
    min-height: 100vh;
    background-color: var(--light-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    padding:20px;
    }

    .container1 form{
    padding:20px;
    background-color: var(--white);
    box-shadow: var(--box-shadow);
    text-align: center;
    width: 500px;
    border-radius: 5px;
    }

    .container1 form h3{
    margin-bottom: 10px;
    font-size: 30px;
    color:var(--black);
    text-transform: uppercase;
    }

    .container1 form .box{
    width: 100%;
    border-radius: 5px;
    padding:12px 14px;
    font-size: 18px;
    color:var(--black);
    margin:10px 0;
    background-color: var(--light-bg);
    }

    .container1 form p{
    margin-top: 15px;
    font-size: 20px;
    color:var(--black);
    }

    .container1 form p a{
    color:var(--red);
    }

    .container1 form p a:hover{
    text-decoration: underline;
    }

</style>
<div class="container1">
    <form action="" method="post" enctype="multipart/form-data">
        <h1 align="center"><span id="sup">SUP</span><span id="mti">MTI</span></h1>
        <h3>Login</h3>
        <?php
        if($message != ''){
            echo '<div class="message">'.$message.'</div>';
        }
        ?>
        <input type="email" name="email" placeholder="Enter email" class="box" required>
        <input type="password" name="password" placeholder="Enter password" class="box" required>
        <input type="submit" class='btn btn-danger'name="submit" value="Login now">
        <p>Don't have an account? <a href="register.php">Register now</a></p>
    </form>
</div>
<?php include('includes/footer.php'); ?>
