<?php
    $pageTitle="Contact us";
    include('includes/header.php')
    ?>
    <?php
    // Récupérer les paramètres du site à partir de la base de données
    $query = "SELECT * FROM settings";
    $result = mysqli_query($connexion, $query);
    $setting = mysqli_fetch_assoc($result);

    if(isset($_POST['submit'])){
        // Récupérer les données du formulaire
        $name = mysqli_real_escape_string($connexion, $_POST['nom']);
        $email = mysqli_real_escape_string($connexion, $_POST['email']);
        $message = mysqli_real_escape_string($connexion, $_POST['message']);
        // Insérer les données dans la base de données
        $query1 = "INSERT INTO contact_us (nom, email, message) VALUES ('$name', '$email', '$message')";
        $result1 = mysqli_query($connexion, $query1);
        if($result1){
            echo "<div class='alert alert-success'>Message sent successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error sending message. Please try again!</div>";
        }
    }
?>
<style>
    .box{
    width: 100%;
    border-radius: 5px;
    padding:12px 14px;
    font-size: 18px;
    color:var(--black);
    margin:10px 0;
    background-color: var(--light-bg);
    }
</style>

<div class="py-5 bg-success">
    <div class="container">
        <h4 class="text-white text-center">Contact us</h4>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h3>Contact Form</h3>
                <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="box" name="nom" aria-describedby="emailHelp" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="box" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="box" name="message" rows="6" required></textarea>
                        </div>
                        <div class="mx-auto">
                        <button type="submit" name="submit" class="btn btn-success text-right">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php')?>