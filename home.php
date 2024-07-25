<?php 
$pageTitle="SUP MTI 😊";
include('includes/header.php');
?>
<style>
    .showcase {
    width: 100%;
    height: 600px;
    background: url('img/home.jpg') no-repeat center center/cover;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    justify-content: flex-end;
    padding-bottom: 50px;
    margin-bottom: 20px;
    }
    .showcase h1, .showcase p {
    margin-bottom: 10px;
    }
    .showcase .btn {
    margin-top: 20px;
    }
    #a{
        color:green;
    }
    #b{
        color:red;
    }
</style>
    <!-- Showcase -->
    <header class="showcase">
      <h1><spam id='a'>SUP</spam><spam id='b'>MTI</spam></h1>
      <H6>
        Ecole Superieur Management Telecommunication Informatique
      </H6>
      <a href="login.php" class="btn btn-danger">
        Inscrire maintenent <i class="fas fa-chevron-right"></i>
      </a>
    </header>

<?php include('includes/footer.php'); ?>