<?php include('includes/header.php') ?>
<?php 
require_once 'config.php';
if ($connexion->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // Fetch data from the database
  $id = $_GET["id"];
  $sql = "SELECT * FROM user_form WHERE id=$id";
  $result = $connexion->query($sql);
  
  // Display data in a readable format
  if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
    $imagePath = "uploads/{$row['nom']}.{$row['prenom']}/{$row['image']}";
    $pdfPath_bac="uploads/{$row['nom']}.{$row['prenom']}/{$row['bac_file']}";
    $pdfPath_cin="uploads/{$row['nom']}.{$row['prenom']}/{$row['cin_file']}";
    $pdfPath_releve="uploads/{$row['nom']}.{$row['prenom']}/{$row['releve']}";
    $pdfPath_diplome="uploads/{$row['nom']}.{$row['prenom']}/{$row['diplome_file']}";

    if (!file_exists('uploads')) {
        mkdir('uploads', 0755, true);
      }
      // Modifier les autorisations du dossier uploads
      chmod("uploads", 0755);            
      
      echo "
    <div class='row'>
    <div class='col-md-12'>
    <div class='card'>
    <div class='card-header'>
    <h4>
      show user 
    <a href='users.php' class='btn btn-danger float-end'>back</a>
    </h4>
    </div>
    <div class='card-body'>
    <style>
    .profile-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      margin: 0 auto;
      display: block;
    }
  </style>
<div class='container'>
  <div class='card'>
  <img src='{$imagePath}' class='profile-img' alt='Profile Picture'>
      <div class='card-body text-center'>
      <h5 class='card-title'>". $row["user-name"]."</h5>
      <p class='card-text'></p>
    </div>
    <ul class='list-group list-group-flush'>
      <li class='list-group-item'>ID : ". $row["id"]."</li>
      <li class='list-group-item'>Nom: ". $row["nom"]."</li>
      <li class='list-group-item'>Prenom : ". $row["prenom"]."</li>
      <li class='list-group-item'>Eamil : ". $row["email"]."</li>
      <li class='list-group-item'>Le nom en arabe  ". $row["arb_nom"]."</li>
      <li class='list-group-item'>Le prenom en arabe : ". $row["arb_prenom"]."</li>
      <li class='list-group-item'>tel : ". $row["tel"]."</li>
      <li class='list-group-item'>adresse : ". $row["adresse"]."</li>
      <li class='list-group-item'>Ville: ". $row["ville"]."</li>
      <li class='list-group-item'>Pays : ". $row["pays"]."</li>
      <li class='list-group-item'>CIN :". $row["cin"]."</li>
      <li class='list-group-item'>Sexe : ". $row["sexe"]."</li>
      <li class='list-group-item'>situation Familiale : ". $row["sitiationFamiliale"]."</li>
      <li class='list-group-item'>Date de Naissance : ". $row["dateNaissance"]."</li>
      <li class='list-group-item'>Diploma :". $row["diploma"]."</li>
      <li class='list-group-item'>Access Level: ". $row["accessLevel"]."</li>
      <li class='list-group-item'>Access Level Option: ". $row["accessLevelOption"]."</li>
      <li class='list-group-item'>Option :". $row["optionn"]."</li>
      <li class='list-group-item'>Type diplome: ". $row["type_diplome"]."</li>
      ";
    }
  } else {
    echo "0 results";
  }
  $connexion->close();
  
?>
<?php
if (is_readable($pdfPath_bac) && is_readable($pdfPath_cin) && is_readable($pdfPath_releve) && is_readable($pdfPath_diplome)) {
?>
    <li class='list-group-item'>PDF BAC : <a href="<?php echo $pdfPath_bac; ?>" target="_blank">Voir le PDF</a></li>
    <li class='list-group-item'>PDF cin : <a href="<?php echo $pdfPath_cin; ?>" target="_blank">Voir le PDF</a></li>
    <li class='list-group-item'>PDF Releve : <a href="<?php echo $pdfPath_releve; ?>" target="_blank">Voir le PDF</a></li>
    <li class='list-group-item'>PDF diplome : <a href="<?php echo $pdfPath_diplome; ?>" target="_blank">Voir le PDF</a></li>

<?php
}
else{
?>
    <li class='list-group-item'>PDF BAC : <a href="<?php echo $pdfPath_bac; ?>" target="_blank">Voir le PDF</a></li>
    <li class='list-group-item'>PDF cin : <a href="<?php echo $pdfPath_cin; ?>" target="_blank">Voir le PDF</a></li>
    <li class='list-group-item'>PDF Releve : <a href="<?php echo $pdfPath_releve; ?>" target="_blank">Voir le PDF</a></li>

    <?php
}
?>


</ul>
  </div>
</div>


</div>


<?php include('includes/footer.php') ?>
