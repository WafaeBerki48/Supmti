<?php 
    $pageTitle="Home";
    include('includes/header.php');
    include 'admin/config.php';
    session_start();
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    if(!$user_id){
        header('location:login.php');
        exit;
    }
    $fetch = null;
    $select = mysqli_query($connexion, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
    }
?>
<style>
    .cc{
        margin:40px;
    }
</style>
<div class="row">
    <div class="col-md-4 ">
            <div class="container cc">
                <center>
                        <?php
                            if($fetch && isset($fetch['image'])){
                                echo '<img width="100px" height="150px" style="border-radius:50%;object-fit:cover;" src="admin/uploads/'.$fetch['nom']  . '.' . $fetch['prenom'] . '/' . $fetch['image'].'">';                }else{
                                echo '<img width="100px" height="100px" style="border-radius:50%;object-fit: cover;" src="img/user.">';
                            }
                        ?><br>
                        <?php echo $fetch['nom'],' ', $fetch['prenom']; ?><br><br>
                                <a class="btn bg-success  text-white" href="admin/logout.php">logout</a>
                                <a class="btn bg-danger  text-white" href="cmplt_insc.php">Completer l'inscription</a>

                </center>
            </div>
    </div>
    <div class="col-md-8">
              <img src="img/logo.jpeg" alt="profile_image" id='ab' class="w-100 border-radius-lg shadow-sm">
    </div>

<div>

<?php include('includes/footer.php'); ?>
