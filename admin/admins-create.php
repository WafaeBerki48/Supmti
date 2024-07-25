<?php include('includes/header.php') ?>    
<?php 
    require_once 'config.php';

    // Insert data into the database
    if(isset($_POST['submit'])) {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $password = md5($_POST['password']);
        $email = $_POST["email"];

        $user_email = $_POST['email'];
        $sql_check_email = "SELECT * FROM admins WHERE email = '$user_email'";
        $result = $connexion->query($sql_check_email);
        if ($result->num_rows > 0) {
            echo "Cet email est déjà utilisé. Veuillez en choisir un autre.";
        } 
        else {
            $sql = "INSERT INTO admins (nom, prenom, password, email) VALUES ('$nom', '$prenom', '$password', '$email')";
            if ($connexion->query($sql) === TRUE) {
                echo "Nouvel admin créé avec succès";
            } else {
                echo "Erreur : " . $sql . "<br>" . $connexion->error;
            }
        }
    }

    $connexion->close();
?>

<style>
    .aa {
        font-size: 3px;
    }
    .error-message {
        color: red;
    }
    .invalid-input {
      border: 1px solid red;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    add admin
                    <a href="admins.php" class="btn btn-danger float-end">back</a>
                </h4>
                <form id="myForm2" method="post" action="admins-create.php" enctype="multipart/form-data">
                    <br>
                    <div class="row">
                        <div class="col">
                            Nom: <input type="text" id="nameInput" class="form-control" name="nom" ><br>
                            <div id="nomError" class="error-message"></div>
                        </div>
                        <div class="col">
                            Prenom: <input type="text" id="prenomInput" class="form-control" name="prenom" ><br>
                            <div id="prenomError" class="error-message"></div>
                        </div>
                    </div>
                    <div class="col-8">
                        Email: <input type="text" id="email" class="form-control" name="email" ><br>
                        <div id="emailError" class="error-message"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Password: <input type="password" id="password" class="form-control" name="password" ><br>
                            <div id="passwordError" class="error-message"></div>
                        </div>
                        <div class="col">
                            Password confi: <input type="password" id="password1" class="form-control" name="password1" ><br>
                            <div id="password1Error" class="error-message"></div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success float-end"  type="submit" name="submit">submit</button>
                </form>
                <div id="message"></div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("myForm2").addEventListener("submit", function(event) {
        const formElements = {
            password: document.getElementById("password"),
            password1: document.getElementById("password1"),
            email: document.getElementById("email"),
            nom: document.getElementById("nameInput"),
            prenom: document.getElementById("prenomInput"),
        };

        const errorElements = {
            passwordError: document.getElementById("passwordError"),
            password1Error: document.getElementById("password1Error"),
            emailError: document.getElementById("emailError"),
            nomError: document.getElementById("nomError"),
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
        if (formElements.prenom.value === "") {
            errorElements.prenomError.innerHTML = "S'il vous plaît entrez le prénom";
            formElements.prenom.classList.add("invalid-input");
            isValid = false;
        }
        if (formElements.nom.value === "") {
            errorElements.nomError.innerHTML = "S'il vous plaît entrez le nom";
            formElements.nom.classList.add("invalid-input");
            isValid = false;
        }

        if (formElements.password.value === "") {
            errorElements.passwordError.innerHTML = "S'il vous plaît entrez le mot de passe";
            formElements.password.classList.add("invalid-input");
            isValid = false;
        } else if (!isValidPassword(formElements.password.value)) {
            errorElements.passwordError.innerHTML = "Le mot de passe doit comporter au moins 8 caractères et inclure des lettres majuscules et minuscules, des chiffres et des caractères spéciaux.";
            formElements.password.classList.add("invalid-input");
            isValid = false;
        }
        if (formElements.email.value === "") {
            errorElements.emailError.innerHTML = "Veuillez entrer votre email";
            formElements.email.classList.add("invalid-input");
            isValid = false;
        } else if (!isValidEmail(formElements.email.value)) {
            errorElements.emailError.innerHTML = "Veuillez entrer une adresse e-mail valide (example@gmail.com)";
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
