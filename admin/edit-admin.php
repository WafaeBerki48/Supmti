<?php include('includes/header.php') ?>
<style>
        .error-message {
            color: red;
        }

    .invalid-input {
      border: 1px solid red;
    }
</style>
<?php
    require_once 'config.php';
    if ($connexion->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // Update data in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id = $_POST["id"];
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $password = md5($_POST["password"]);
      $email = $_POST["email"];
      $diplome_file = isset($_POST["diplome_file"]);

    $sql = "UPDATE admins SET nom='$nom', prenom='$prenom',`password`='$password', email='$email'      
    WHERE id=$id";
        if ($connexion->query($sql) === TRUE) {
          echo "Record updated successfully             <a href='admins.php' class='btn btn-danger float-end'>back</a>          ";
          exit(); // Make sure to exit after redirection
        } else {
          echo "Error updating record: " . $connexion->error;
        }
      }

    // Fetch data from the database
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        
        $sql = "SELECT * FROM admins WHERE id=$id";
        $result = $connexion->query($sql);

        if ($result !== false && $result->num_rows > 0) {
        // Output data in editable fields
        while($row = $result->fetch_assoc()) {
            echo "
            <div class='row'>
            <div class='col-md-12'>
            <div class='card'>
            <div class='card-header'>
            <h4>
            Edit user ".$row["nom"]." ".$row["prenom"]."
            <a href='admins.php' class='btn btn-danger float-end'>back</a>
            </h4>
            </div>
            <div class='card-body'>
            <form id='myForm' method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."' enctype='multipart/form-data'>
            <div class='tab' id='tab-1'>
            <h3>Identification</h3>
                <input type='hidden' name='id'  value='".$row["id"]."' >
                <div class='row'>
                <div class='col'>
                <label >Nom:<span>*</span></label>
                <input type='text' id='nameInput' name='nom'value='".$row["nom"]."' class='form-control' placeholder='Enter your name' >
                <div id='nameError' class='error-message'></div></div><br>
                <div class='col'>          
                <label>Prénom:<span>*</span></label>
                <input type='text' id='prenomInput'value='".$row["prenom"]."' name='prenom' class='form-control' placeholder='Enter your firstname' ><div id='prenomError' class='error-message'></div></div></div><br>
                <div class='row'>
                <div class='col'>
                <label>Mot de passe :<span>*</span></label><br>
                <input type='password' id='password' name='password' class='form-control'  ><div id='passwordError' class='error-message'></div></div>
                <div class='col'>
                <label >Confirmer le<span>*</span></label><br>
                <input type='password' id='password1' name='password1' class='form-control' ><div id='password1Error' class='error-message'></div></div></div>
                <div class='col-8'>
                <label >Email :<span>*</span></label><br>
                <input type='text' id='email' name='email'value='".$row["email"]."' class='form-control' ><div id='emailError' class='error-message'></div></div>
                <br>
                <div class='col-2'></div>
                <button class='btn btn-success float-end '  type='submit' name='update'>Update</button>
                <div id='message'></div></div>
        </form> 
        <div id='message'></div>
    
    
                ";
        }
    } else {
        echo "0 results";
    }
  }

  $connexion->close();
?>


<script>
  document.getElementById("myForm").addEventListener("submit", function(event) {
    const formElements = {
      password: document.getElementById("password"),
      password1: document.getElementById("password1"),
      email: document.getElementById("email"),
      name: document.getElementById("nameInput"),
      prenom: document.getElementById("prenomInput"),
    };

    const errorElements = {
      passwordError: document.getElementById("passwordError"),
      password1Error: document.getElementById("password1Error"),
      emailError: document.getElementById("emailError"),
      nameError: document.getElementById("nameError"),
      prenomError: document.getElementById("prenomError"),
    };

    const messageElement = document.getElementById("message");

    let isValid = true;

    // Reset error messages and classes
    Object.values(errorElements).forEach((errorElement) => {
      errorElement.innerHTML = "";
    });
    Object.values(formElements).forEach((formElement) => {
      formElement.classList.remove("invalid-input");
    });
    messageElement.innerHTML = "";

    // Validate form elements
    if (formElements.name.value === "") {
      errorElements.nameError.innerHTML = "S'il vous plaît entrez le nom";
      formElements.name.classList.add("invalid-input");
      isValid = false;
    }

    if (formElements.prenom.value === "") {
      errorElements.prenomError.innerHTML = "S'il vous plaît entrez le prenom";
      formElements.prenom.classList.add("invalid-input");
      isValid = false;
    }
    if (formElements.password.value === "") {
      errorElements.passwordError.innerHTML = "s'il vous plait entrez le mot de passe";
      formElements.password.classList.add("invalid-input");
      isValid = false;
    } else if (!isValidPassword(formElements.password.value)) {
      errorElements.passwordError.innerHTML = "Le mot de passe doit comporter au moins 8 caractères et inclure des lettres majuscules et minuscules, des chiffres et des caractères spéciaux.";
      formElements.password.classList.add("invalid-input");
      isValid = false;
    }
    if (formElements.email.value === "") {
      errorElements.emailError.innerHTML = "Veuillez entrer votre email";
      formElements.email.classList.add("invalid-input");
      isValid = false;
    } else if (!isValidEmail(formElements.email.value)) {
      errorElements.emailError.innerHTML = "veuillez entrer une adresse e-mail valid example@gmail.com";
      formElements.email.classList.add("invalid-input");
      isValid = false;
    }
    if (formElements.password1.value === "") {
      errorElements.password1Error.innerHTML = "Veuillez confirmer votre mot de passe";
      formElements.password1.classList.add("invalid-input");
      isValid = false;
    }

    if (formElements.password.value !== formElements.password1.value) {
      errorElements.passwordError.innerHTML = "Les mots de passe ne correspondent pas";
      errorElements.password1Error.innerHTML = "Les mots de passe ne correspondent pas";
      formElements.password.classList.add("invalid-input");
      formElements.password1.classList.add("invalid-input");
      isValid = false;
    }

    if (!isValid) {
      event.preventDefault(); // Empêcher la soumission du formulaire si la validation échoue
      messageElement.innerHTML = "<br>Veuillez remplir correctement tous les champs obligatoires.";
    }
  });
    function isValidPassword(password) {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return passwordRegex.test(password);
  }
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
</script>
<?php include('includes/footer.php') ?>

