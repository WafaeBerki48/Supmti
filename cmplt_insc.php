
<style>
    .a{
        color:black;
    }
    #sup{
        color: green;
    }
    #mti{
        color: red;
    }
    body{
    background: #eaeaea;
    }

    form{
    background: #FAF9F6;
    margin: 100px auto;
    padding: 15px 40px 40px 40px;
    width: 70%;
    }

    .tab p{
    font-size: 20px;
    margin: 0 0 10px 0;
    }

    input{
    margin: 10px 0;
    padding: 10px;
    box-sizing: border-box;
    width: 100%;
    font-size: 17px;
    border: 1px solid #aaaaaa;
    }

    .index-btn-wrapper{
    display: flex;
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

    .index-btn{
    margin: 20px 15px 0 0;
    background: #04AA6D;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    cursor: pointer;
    transition: 0.3s;
    }

    .index-btn:hover{
    opacity: 0.8;
    }

    .step{
    height: 30px;
    width: 30px;
    line-height: 30px;
    margin: 0 2px;
    color: white;
    background: rgb(10, 69, 10);
    border-radius: 50%;
    display: inline-block;
    opacity: 0.25;
    }

    .btn
    .delete-btn{
    width: 100%;
    border-radius: 5px;
    padding:10px 30px;
    color:var(--white);
    display: block;
    text-align: center;
    cursor: pointer;
    font-size: 20px;
    margin-top: 10px;
    }

</style>

<?php
    $pageTitle="complet m'inscription";
    include('includes/header.php');
    include 'admin/config.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    $select = mysqli_query($connexion, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
    $fetch = mysqli_fetch_assoc($select);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $update_nom = mysqli_real_escape_string($connexion, $_POST['nom']);
        $update_prenom = mysqli_real_escape_string($connexion, $_POST['prenom']);
        $update_arb_n = mysqli_real_escape_string($connexion, $_POST['arb_nom']);
        $update_arb_p = mysqli_real_escape_string($connexion, $_POST['arb_prenom']);
        $update_user = mysqli_real_escape_string($connexion, $_POST['user-name']);
        $update_cin = mysqli_real_escape_string($connexion, $_POST['cin']);
        $update_sexe = mysqli_real_escape_string($connexion, $_POST['sexe']);
        $update_st = mysqli_real_escape_string($connexion, $_POST['sitiationFamiliale']);
        $update_dt = mysqli_real_escape_string($connexion, $_POST['dateDeNaissance']);
        $update_adrs = mysqli_real_escape_string($connexion, $_POST['adresse']);
        $update_ville = mysqli_real_escape_string($connexion, $_POST['ville']);
        $update_tel = mysqli_real_escape_string($connexion, $_POST['tel']);
        $update_diploma = mysqli_real_escape_string($connexion, $_POST['diploma']);
        $update_tp_dip = isset($_POST['type_diplome']) ? mysqli_real_escape_string($connexion, $_POST['type_diplome']) : '';
        $update_option = isset($_POST['option']) ? mysqli_real_escape_string($connexion, $_POST['option']) : '';
        $update_acc_lvl_op = isset($_POST['accessLevelOption']) ? mysqli_real_escape_string($connexion, $_POST['accessLevelOption']) : '';
        $update_acc_lvl = isset($_POST['accessLevel']) ? mysqli_real_escape_string($connexion, $_POST['accessLevel']) : '';

        // Chemin du dossier où les fichiers seront enregistrés
        $folder_path = "admin/uploads/$update_nom.$update_prenom";
        // Vérifie si le dossier existe, sinon le crée
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0777, true);
        }
        // Traitement des fichiers uploadés
        if(isset($_FILES['cin_file']) && !empty($_FILES['cin_file']['name'])) {
            $cin_file = $_FILES['cin_file'];
            $cin_file_name = "$update_nom.cin." . pathinfo($cin_file['name'], PATHINFO_EXTENSION);
            move_uploaded_file($cin_file['tmp_name'], "$folder_path/$cin_file_name");
        }
        if(isset($_FILES['bac_file']) && !empty($_FILES['bac_file']['name'])) {
            $bac_file = $_FILES['bac_file'];
            $bac_file_name = "$update_nom.bac." . pathinfo($bac_file['name'], PATHINFO_EXTENSION);
            move_uploaded_file($bac_file['tmp_name'], "$folder_path/$bac_file_name");
        }
        if(isset($_FILES['releve']) && !empty($_FILES['releve']['name'])) {
            $releve = $_FILES['releve'];
            $releve_file_name = "$update_nom.releve." . pathinfo($releve['name'], PATHINFO_EXTENSION);
            move_uploaded_file($releve['tmp_name'], "$folder_path/$releve_file_name");
        }
        $diplome_file_name = '';
        if(isset($_FILES['diplome_file']) && !empty($_FILES['diplome_file']['name'])) {
            $diplome_file = $_FILES['diplome_file'];
            $diplome_file_name = "$update_nom.diplome." . pathinfo($diplome_file['name'], PATHINFO_EXTENSION);
            move_uploaded_file($diplome_file['tmp_name'], "$folder_path/$diplome_file_name");
        }
        $sql = mysqli_query($connexion, "UPDATE `user_form` SET 
        nom = '$update_nom',
        prenom = '$update_prenom',
        arb_nom = '$update_arb_n',
        arb_prenom = '$update_arb_p',
        `user-name` = '$update_user',
        cin = '$update_cin',
        sexe = '$update_sexe',
        sitiationFamiliale = '$update_st',
        dateNaissance = '$update_dt',
        adresse = '$update_adrs',
        ville = '$update_ville',
        tel = '$update_tel',
        diploma = '$update_diploma',
        accessLevel = '$update_acc_lvl',
        accessLevelOption = '$update_acc_lvl_op',
        optionn = '$update_option',
        type_diplome = '$update_tp_dip',
        cin_file = '$cin_file_name',
        bac_file = '$bac_file_name',
        releve = '$releve_file_name',
        diplome_file = '$diplome_file_name'
        WHERE id = '$user_id'") or die('La requête a échoué');

    if ($sql) {
    echo "<div class='p-3 mb-2 bg-success text-white'>Les données ont été mises à jour avec succès</div>";
    } else {
    echo "Error: " . $sql . "<br>" . $connexion->error;
    }
      }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
#convocation{
    display: none;
    }
</style>
      <a href="index.php" class="btn btn-danger" >back</a>
<form id="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <h1 align="center">Register</h1>

    <div style="text-align:center;">
        <span class="step" id="step-1">1</span>
        <span class="step" id="step-2">2</span>
        <span class="step" id="step-3">3</span>
        <span class="step" id="step-4">4</span>
    </div>

    <div class="tab" id="tab-1">
        <h3>Identification</h3>
        <div class="form-group">
            <label for="nameInput">User name:<span>*</span></label>
            <input type="text" name="user-name" id="nameInput" value="<?php echo $fetch['user-name']; ?>" name="user-name" class="form-control" placeholder="Enter your username" required><br>

            <label for="nameInput">Nom:<span>*</span></label>
            <input type="text" id="nameInput" value="<?php echo $fetch['nom']; ?>" name="nom" class="form-control" placeholder="Enter your name" required><br>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom:<span>*</span></label>
            <input type="text" id="prenomInput" value="<?php echo $fetch['prenom']; ?>" name="prenom" class="form-control" placeholder="Enter your firstname" required><br>
            <label for="nom"> :الاسم العائلي <span>*</span></label><br>
        </div>
        <div class="form-group">
            <input type="text" id="name" class="form-control" value="<?php echo isset($fetch['arb_nom']) ? $fetch['arb_nom'] : ''; ?>" name="arb_nom" placeholder="أدخل اسمك العائلي" required>
        </div>
        <div class="form-group">
            <label for="prenom">:الاسم الشخصي<span>*</span></label><br>
            <input type="text" id="prenom" value="<?php echo isset($fetch['arb_prenom']) ? $fetch['arb_prenom'] : ''; ?>" name="arb_prenom" class="form-control" placeholder="أدخل اسمك الشخصي" required>
        </div>
        <div class="form-group">
                <label for="cinInput">CIN:</label>
                <input type="text" class="form-control" id="cinInput" value="<?php echo isset($fetch['cin']) ? $fetch['cin'] : ''; ?>" name="cin" required>
        </div>
        <div class="form-group">
                <label for="sexe">Sexe:</label>
                <select id="sexe" name="sexe" class="form-control" required>
                    <option value="" disabled>Choisissez votre sexe</option>
                    <option value="m" <?php if(isset($fetch['sexe']) && $fetch['sexe'] == 'm') echo 'selected'; ?>>Masculin</option>
                    <option value="f" <?php if(isset($fetch['sexe']) && $fetch['sexe'] == 'f') echo 'selected'; ?>>Féminin</option>
                </select>
        </div><br>
        <div class="form-group">
                <label for="situationFamiliale">Situation familiale:</label>
                <select id="situationFamiliale" name="sitiationFamiliale" class="form-control">
                    <option value="" disabled>Choisissez votre situation familiale</option>
                    <option value="celibataire" <?php if(isset($fetch['situationFamiliale']) && $fetch['situationFamiliale'] == 'celibataire') echo 'selected'; ?>>Célibataire</option>
                    <option value="marié" <?php if(isset($fetch['situationFamiliale']) && $fetch['situationFamiliale'] == 'marié') echo 'selected'; ?>>Marié(e)</option>
                    <option value="divorcé" <?php if(isset($fetch['situationFamiliale']) && $fetch['situationFamiliale'] == 'divorcé') echo 'selected'; ?>>Divorcé(e)</option>
                    <option value="veuf" <?php if(isset($fetch['situationFamiliale']) && $fetch['situationFamiliale'] == 'veuf') echo 'selected'; ?>>Veuf(e)</option>
                </select><br></div>

                <label for="dateDeNaissance">Date de naissance:<span>*</span></label>
                <?php
                  $dateDeNaissance = isset($fetch['dateNaissance']) ? date('Y-m-d', strtotime($fetch['dateNaissance'])) : '';
                ?>
              <input type="date" id="dateDeNaissance" name="dateDeNaissance" class="form-control" value="<?php echo $dateDeNaissance; ?>" required><br>
                <label for="adresse">Adresse:</label>
                <input id="adresse" name="adresse" class="form-control" value="<?php echo isset($fetch['adresse']) ? $fetch['adresse'] : ''; ?>" required><br>

                <label for="ville">Ville:<span>*</span></label>
                <input id="text" name="ville" class="form-control" value="<?php echo isset($fetch['ville']) ? $fetch['ville'] : ''; ?>" required><br>
                <label for="tel">Tél: <span>*</span></label>
                <input type="tel" id="tel" name="tel" class="form-control" placeholder="Entréz votre numero de telephone" value="<?php echo isset($fetch['tel']) ? $fetch['tel'] : ''; ?>" required><br>
                <div class="index-btn-wrapper">
          <div class="index-btn" onclick="run(1, 2);">Next</div>
        </div>
      </div>

      <div class="tab" id = "tab-2">
      <h3>Formation</h3>
            

    <label for="diploma">l'année d'arrêt:</label>
    <select id="degree" name="diploma">
    <option value="BAC" <?php if(isset($fetch['diploma']) && $fetch['diploma'] == 'BAC') echo 'selected'; ?>>BAC</option>
    <option value="BAC+2" <?php if(isset($fetch['diploma']) && $fetch['diploma'] == 'BAC+2') echo 'selected'; ?>>BAC+2</option>
    <option value="BAC+3" <?php if(isset($fetch['diploma']) && $fetch['diploma'] == 'BAC+3') echo 'selected'; ?>>BAC+3</option>
    </select><br><br>


  <label for="select1">Select your first option:</label>
  <select id="select1" name="accessLevel">
    <option value="" selected disabled> choisi ...</option>
    <option value="LETTER" <?php if(isset($fetch['accessLevel']) && $fetch['accessLevel'] == 'LETTER') echo 'selected'; ?>>LETTER</option>
    <option value="SCIENTIFIC" <?php if(isset($fetch['accessLevel']) && $fetch['accessLevel'] == 'SCIENTIFIC') echo 'selected'; ?>>SCIENTIFIC</option>
  </select><br><br>

  <label for="select2"> Niveau d'accée:</label>
  <select id="select2" name="accessLevelOption">
    <option value="" selected disabled>choisi ...</option>
    <option value="BAC+3" <?php if(isset($fetch['accessLevelOption']) && $fetch['accessLevelOption'] == 'BAC+3') echo 'selected'; ?>>BAC+3</option>
    <option value="BAC+5" <?php if(isset($fetch['accessLevelOption']) && $fetch['accessLevelOption'] == 'BAC+5') echo 'selected'; ?>>BAC+5</option>
  </select><br><br>


  <label for=""> Option :</label><br>
  <label for="management">MANAGEMENT:</label>
  <input type="radio" id="management" name="option" value="management" <?php if(isset($fetch['option']) && $fetch['option'] == 'management') echo 'checked'; ?> disabled>

  <label for="informatique">INFORMATIQUE:</label>
  <input type="radio" id="informatique" name="option" value="informatique" <?php if(isset($fetch['option']) && $fetch['option'] == 'informatique') echo 'checked'; ?> disabled>

  <label for="telecommunication">TELECOMMUNICATION:</label>
  <input type="radio" id="telecommunication" name="option" value="telecommunication" <?php if(isset($fetch['option']) && $fetch['option'] == 'telecommunication') echo 'checked'; ?> disabled>
 
    <input type="text" id="diplome" name="type_diplome" placeholder="Votre_diplome" value="<?php echo isset($fetch['type_diplome']) ? $fetch['type_diplome'] : ''; ?>" disabled>
    <div id="additionalFields2"style="display:none;">
    </div>

        <div class="index-btn-wrapper">
          <div class="index-btn" onclick="run(2, 1);">Previous</div>
          <div class="index-btn" onclick="run(2, 3);">Next</div>
        </div>
      </div>

    <div class="tab" id = "tab-3">
    <label for="">CIN :<span>*</span></label>  
    <input type="file" id="fileInput" name="cin_file" accept="application/pdf" multiple required><div id="fileList"></div><br>
    <label for="">BACCALAUREAT :<span>*</span></label>
    <input type="file" id="fileInput2" name="bac_file" accept="application/pdf" multiple required><div id="fileList2"></div><br>
    <label for="">RELVE DE NOTES DE VOTRE BAC :<span>*</span></label>
    <input type="file" id="fileInput3" name="releve" accept="application/pdf" multiple required><div id="fileList3"></div><br>      
    <label for="">Diplome :</label>
    <input type="file" id="pdiblome" name="diplome_file" accept="application/pdf" disabled>


        <div class="index-btn-wrapper">
          <div class="index-btn" onclick="run(3, 2);">Previous</div>
          <div class="index-btn" onclick="run(3, 4);">Next</div>
        </div>
    </div>

      <div class="tab" id = "tab-4">
      <h1>Toutes vos informations sont soigneusement conservées</h1>
        <div class="index-btn-wrapper">
          <div class="index-btn" onclick="run(5, 4);">Previous</div>
          <button class = "index-btn" type="submit" name="update_profile" style = "background: blue;" >Submit</button>
        </div>
      </div>
    </form>

<script>
  const degreeSelect = document.getElementById("degree");
  const nameInput = document.getElementById("diplome");
  const photoInput = document.getElementById("pdiblome");

  degreeSelect.addEventListener("change", () => {
    if (degreeSelect.value === "BAC") {
      nameInput.setAttribute("disabled", true);
      photoInput.setAttribute("disabled", true);
      
    } else {
        nameInput.removeAttribute("disabled");
      photoInput.removeAttribute("disabled");
    }
  });
</script>
<script>
    const diplomaSelect = document.getElementById("diploma");
    const additionalFields = document.getElementById("additionalFields");

    diplomaSelect.addEventListener("change", (event) => {
      if (event.target.value === "BAC+2" || event.target.value === "BAC+3") {
        additionalFields.style.display = "block";
      } else {
        additionalFields.style.display = "none";
      }
    });
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');

    fileInput.addEventListener('change', function() {
      const files = fileInput.files;
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const li = document.createElement('li');
        li.textContent = file.name;
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Supprimer';
        deleteButton.addEventListener('click', function() {
          const index = Array.from(fileInput.files).findIndex(f => li.remove());
          
        });
        li.appendChild(deleteButton);
        fileList.appendChild(li);
      }
    });
</script>
<script>
  const fileInput2 = document.getElementById('fileInput2');
  const fileList2 = document.getElementById('fileList2');

  fileInput2.addEventListener('change', function() {
    const files = fileInput2.files;
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const li = document.createElement('li');
      li.textContent = file.name;
      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Supprimer';
      deleteButton.addEventListener('click', function() {
        const index = Array.from(fileInput2.files).findIndex(f => li.remove());
        
      });
      li.appendChild(deleteButton);
      fileList2.appendChild(li);
    }
  });
</script>
<script>
  const fileInput3 = document.getElementById('fileInput3');
  const fileList3 = document.getElementById('fileList3');

  fileInput3.addEventListener('change', function() {
    const files = fileInput3.files;
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const li = document.createElement('li');
      li.textContent = file.name;
      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Supprimer';
      deleteButton.addEventListener('click', function() {
        const index = Array.from(fileInput3.files).findIndex(f => li.remove());
        
      });
      li.appendChild(deleteButton);
      fileList3.appendChild(li);
    }
  });
</script>
<script>
      $(".tab").css("display", "none");
      $("#tab-1").css("display", "block");

      function run(hideTab, showTab){
        if(hideTab < showTab){ 
          var currentTab = 0;
          x = $('#tab-'+hideTab);
          y = $(x).find("input[required], select[required]")
          for (i = 0; i < y.length; i++){
            if (y[i].value == ""){
              $(y[i]).css("background", "#ffdddd");
              return false;
            }
          }
        }

        // Progress bar
        for (i = 1; i < showTab; i++){
          $("#step-"+i).css("opacity", "1");
        }

        // Switch tab
        $("#tab-"+hideTab).css("display", "none");
        $("#tab-"+showTab).css("display", "block");
        $("input[required], select[required]").css("background", "#fff");
      }
      function onsubmit(){
        alert('Send Successfully');
   document.location.href ='INDEX2.html';
   
      }
</script>
<script>
  const select1 = document.getElementById("select1");
  const select2 = document.getElementById("select2");
  const management = document.getElementById("management");
  const informatique = document.getElementById("informatique");
  const telecommunication = document.getElementById("telecommunication");

  select1.addEventListener("change", () => {
    if (select1.value === "LETTER") {
      management.disabled = false;
      informatique.disabled = true;
      telecommunication.disabled = true;
    } else if (select1.value === "SCIENTIFIC") {
      select2.addEventListener("change", () => {
        if (select2.value === "BAC+3") {
          management.disabled = false;
          informatique.disabled = false;
          telecommunication.disabled = true;
        } else if (select2.value === "BAC+5") {
          management.disabled = false;
          informatique.disabled = false;
          telecommunication.disabled = false;
        }
      });
    }
  });
</script>
<script>
    function updateGreeting() {
    
    var prenomInput = document.getElementById("prenomInput");
    var prenom = prenomInput.value;
    var greeting2 = document.getElementById("greeting2");
    greeting2.textContent = prenom;
    var nameInput = document.getElementById("nameInput");
    var name = nameInput.value;
    var greeting = document.getElementById("greeting");
    greeting.textContent = name;
    var dateInput = document.getElementById("dateInput");
    var selectedOption = dateInput.options[dateInput.selectedIndex];
    var dat_passage = selectedOption.textContent;
    
    var date_pass = document.getElementById("date_pass");
    date_pass.textContent = dat_passage;
    var CentreInput = document.getElementById("CentreInput");
    var selectedOption = CentreInput.options[CentreInput.selectedIndex];
    var Centre_passage = selectedOption.textContent;
    
    var Centre_pass = document.getElementById("Centre_pass");
    Centre_pass.textContent = Centre_passage;
  }
</script>
<script>
  // Sélectionner le bouton "Imprimer"
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
      });</script>
<script>
  methods: {
    checkFormValidity() ;{
      this.formValid = this.$refs.myForm.checkValidity();
      if (this.formValid) {
        // submit the form
        this.$refs.myForm.submit();
      }
    }
  }
</script>
<step-navigation :steps="steps" :currentstep="currentstep" :formValid="formValid" @form-change="formChanged"></step-navigation>
</form>

<script>
    const form2 = document.getElementById("myForm2");
    const additionalOptions = document.getElementById("additionalOptions");
    const letterOptions = document.getElementById("letterOptions");
    const scientificOptions = document.getElementById("scientificOptions");
    const scientificTelecommunication = document.getElementById("scientificTelecommunication");

    form2.addEventListener("change", (event) => {
        if (event.target.name === "accessLevel") {
            additionalOptions.style.display = "block";
        }
    });

    form2.addEventListener("change", (event) => {
    if (event.target.name === "accessLevelOption") {
        if (event.target.value === "BAC+3") {
            if (document.getElementById("letter").checked) {
                letterOptions.style.display = "block";
                scientificOptions.style.display = "none";
                scientificTelecommunication.style.display = "none";
            } else if (document.getElementById("scientific").checked) {
                letterOptions.style.display = "none";
                scientificOptions.style.display = "block";
                scientificTelecommunication.style.display = "none";
            }
        } else if (event.target.value === "BAC+5") {
            if (document.getElementById("letter").checked) {
                letterOptions.style.display = "block";
                scientificOptions.style.display = "none";
                scientificTelecommunication.style.display = "none";
            } else if (document.getElementById("scientific").checked) {
                letterOptions.style.display = "none";
                scientificOptions.style.display = "block";
                scientificTelecommunication.style.display = "block";
            }
        }
    }
  });

  form2.addEventListener("change", (event) => {
    if (event.target.name === "accessLevel") {
        if (event.target.value === "LETTER") {
            document.getElementById("accessLevelOption").value = "BAC+3";
            letterOptions.style.display = "block";
            scientificOptions.style.display = "none";
            scientificTelecommunication.style.display = "none";
        } else if (event.target.value === "SCIENTIFIC") {
            document.getElementById("accessLevelOption").value = "BAC+3";
            letterOptions.style.display = "none";
            scientificOptions.style.display = "block";
            scientificTelecommunication.style.display = "none";
        }
    }
  });  
</script>


<script>
    const form2 = document.getElementById("myForm2");
    const additionalOptions = document.getElementById("additionalOptions");
    const letterOptions = document.getElementById("letterOptions");
    const scientificOptions = document.getElementById("scientificOptions");
    const scientificTelecommunication = document.getElementById("scientificTelecommunication");

    form2.addEventListener("change", (event) => {
        if (event.target.name === "accessLevel") {
            additionalOptions.style.display = "block";
        }
    });

    form2.addEventListener("change", (event) => {
        if (event.target.name === "accessLevelOption") {
            if (event.target.value === "BAC+3") {
                if (document.getElementById("letter").checked) {
                letterOptions.style.display = "block";
                scientificOptions.style.display = "none";
                scientificTelecommunication.style.display = "none";
            } else if (document.getElementById("scientific").checked) {
                letterOptions.style.display = "none";
                scientificOptions.style.display = "block";
                scientificTelecommunication.style.display = "none";
            }
        } else if (event.target.value === "BAC+5") {
            if (document.getElementById("letter").checked) {
                letterOptions.style.display = "block";
                scientificOptions.style.display = "none";
                scientificTelecommunication.style.display = "none";
            } else if (document.getElementById("scientific").checked) {
                letterOptions.style.display = "none";
                scientificOptions.style.display = "block";
                scientificTelecommunication.style.display = "block";
                }
            }
        }
    });

    form2.addEventListener("change", (event) => {
        if (event.target.name === "accessLevel") {
            if (event.target.value === "LETTER") {
            document.getElementById("accessLevelOption").value = "BAC+3";
            letterOptions.style.display = "block";
            scientificOptions.style.display = "none";
            scientificTelecommunication.style.display = "none";
        } else if (event.target.value === "SCIENTIFIC") {
            document.getElementById("accessLevelOption").value = "BAC+3";
            letterOptions.style.display = "none";
            scientificOptions.style.display = "block";
            scientificTelecommunication.style.display = "none";
          }
      }
  });
</script>
<?php include('includes/footer.php'); ?>
