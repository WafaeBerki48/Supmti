<?php
  // Récupérer les paramètres du site à partir de la base de données
  $query = "SELECT * FROM settings";
  $result = mysqli_query($connexion, $query);
  $setting = mysqli_fetch_assoc($result);
?>
<div class="sticky-top">
  <div class="bg-success py-2">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-white">
          Email : <?php echo $setting['email1'] ?? ''; ?>      
          -------- tel : <?php echo $setting['tel'] ?? ''; ?>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg bg-white shadow sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">Supmti</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about-us.php">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"href="services.php" >services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"href="contact-us.php" >Contact Us</a>
          </li>
          <li>
            <a class="btn btn-success"href="concours.php" >Inscrire au concours</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
