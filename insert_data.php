<?php
$pageTitle="Concours";
include('includes/header.php');
require_once 'admin/config.php'; 
  require_once 'admin/config.php';

  if ($connexion->connect_error) {
      die("La connexion a échoué : " . $connexion->connect_error);
  }

  // Vérifier si le formulaire a été soumis
  if (isset($_POST['submit'])) {
      // Récupérer le CIN du formulaire
      $cin = $_POST['cin'];

      // Vérifier si l'utilisateur existe déjà dans la table
      $sql_check = "SELECT * FROM concours WHERE cin = '$cin'";
      $result_check = $connexion->query($sql_check);

      if ($result_check->num_rows > 0) {
          echo "L'utilisateur avec le numéro CIN $cin existe déjà dans la base de données.";
      } else {
          // Récupérer les autres valeurs du formulaire
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $genre = $_POST['genre'];
          $pays = $_POST['pays'];
          $tel = $_POST['tel'];
          $dateDeNaissance = $_POST['dateDeNaissance'];
          $centre = $_POST['centre'];
          $date = $_POST['date'];
          $email = $_POST['email'];
          $degree = $_POST['degree'];
          $ville = $_POST['ville'];
          $diplome = isset($_POST['diplome']) ? $_POST['diplome'] : '';
          $accessLevel = $_POST['accessLevel'];
          $accessLevelOption = $_POST['accessLevelOption'];
          $option = isset($_POST['optionn']) ? $_POST['optionn'] : '';

          // Requête SQL pour insérer les données dans la table concours
          $sql_insert = "INSERT INTO concours (nom, prenom, cin, genre, pays, tel, dateDeNaissance, centre, date, email, degree, ville, diplome, accessLevel, accessLevelOption, optionn)
          VALUES ('$nom', '$prenom', '$cin', '$genre', '$pays', '$tel', '$dateDeNaissance', '$centre', '$date', '$email', '$degree', '$ville', '$diplome', '$accessLevel', '$accessLevelOption', '$option')";

          if ($connexion->query($sql_insert) === TRUE) {
              echo "Enregistrement effectué avec succès";
          } else {
              echo "Erreur d'enregistrement : " . $connexion->error;
          }
      }
  }

  // Fermer la connexion à la base de données
  $connexion->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>#convocation{
    display: none;
  }</style>
</head>
<body>
   
<div class="card-body">
<div class="container">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

    <fieldset>
        <h2 class="fs-title">Confirmation</h2>
        <h4 class="fs-subtitle">Les informations suivantes seront confirmées :</h4>
        <div id="confirmationSection">
            <ul>
                <li>Nom : <?php echo isset($nom) ? $nom : ''; ?> <?php echo isset($prenom) ? $prenom : ''; ?></li>
                <li>CIN : <?php echo isset($cin) ? $cin : ''; ?></li>
                <li>Centre de passage : <?php echo isset($centre) ? $centre : ''; ?></li>
                <li>Date de passage : <?php echo isset($date) ? $date : ''; ?> </li>
                <li>Adresse email : <?php echo isset($email) ? $email : ''; ?> </li>
            
            </ul>
            <p>Merci pour votre confirmation !</p>
        </div>
        <button class='btn  btn-danger' id="print-button" >Imprimer </button><br><br>
        <form action="send.php" method="post">
        <button class='btn  btn-danger' name="send" type="">SEND CONVOCATION PAR EMAIL</button></form>

        <!-- <button id="button" onclick="window.print()">Imprimer</button> -->
    </fieldset>
    <div id="convocation" >
    <img src="img/logo.jpeg" alt=""  style="padding-left:100px;text-align: center;width:600px;hight:400ox;">

    <u> <h1>Convocation d'inscription</h1></u>
    <div id="confirmationSection">
    <h2>Dear  <b><?php echo isset($nom) ? $nom : ''; ?> <?php echo isset($prenom) ? $prenom : ''; ?></b></h2>
    <p style="font-size: 20px;">Voici votre convocation pour le concours scolaire :
  Nous avons le plaisir de vous informer que vous avez été inscrit avec succès au concours scolaire.
  La compétition aura lieu dans <b> <?php echo isset($date) ? $date : ''; ?> à  <?php echo isset($centre) ? $centre : ''; ?></b>. Veuillez arriver sur le site de la compétition avant 8h00.
  Le coup d’envoi de la compétition sera donné à 9h00 précises.
  Bonne chance!
  Le comité du concours de l’école :</p>
  <img src="img/10.png" alt=""  style="padding-top: 250px; padding-left: 400px;">

        </div>  </div>
 


<script>// Sélectionner le bouton "Imprimer"
    const printButton = document.getElementById("print-button");
    
    // Ajouter un gestionnaire d'événement pour le clic sur le bouton "Imprimer"
    printButton.addEventListener("click", () => {
      // Sélectionner l'élément à imprimer
      const convocation = document.getElementById("convocation");
    
      // Ouvrir une fenêtre d'impression
      const printWindow = window.open("", "", "height=600,width=800");
    
      // Écrire le contenu de l'élément à imprimer dans la fenêtre d'impression
      printWindow.document.write(convocation.outerHTML);
    
      // Imprimer la fenêtre
      printWindow.print();
    
      // Fermer la fenêtre
      printWindow.close();
    });
</script>


</body>
</html>
