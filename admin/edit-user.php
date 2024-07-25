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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id = $_POST["id"];
      $user_name=$_POST["user-name"];
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $arb_nom=$_POST["arb_nom"];
      $arb_prenom=$_POST["arb_prenom"];
      $password = md5($_POST["password"]);
      $email = $_POST["email"];
      $cin=$_POST["cin"];
      $sexe=$_POST["sexe"];
      $sitiationFamiliale=$_POST["sitiationFamiliale"];
      $dateNaissance=$_POST["dateDeNaissance"];
      $tel=$_POST["tel"];
      $adresse=$_POST["adresse"];
      $ville=$_POST["ville"];
      $diploma=($_POST["diploma"]);
      $accessLevel=($_POST["accessLevel"]);
      $accessLevelOption=($_POST["accessLevelOption"]);
      $option = isset($_POST["option"]) ? $_POST["option"] : '';
      $diplome=isset($_POST["type_diplome"]);
      $image =  isset($_POST["image"]);
      $cin_file =  isset($_POST["cin_file"]);
      $bac_file = isset( $_POST["bac_file"]);
      $releve =  isset($_POST["releve"]);
      $diplome_file = isset($_POST["diplome_file"]);

    $folder_path = 'uploads/' . $nom . '.' . $prenom;
    if (!file_exists($folder_path)) {
      mkdir($folder_path, 0755, true);
    }
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $image = $nom . '.image.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['image']['tmp_name'], $folder_path . '/' . $image);
    }
    $cin_file = '';
    if (isset($_FILES['cin_file']) && $_FILES['cin_file']['error'] === UPLOAD_ERR_OK) {
      $cin_file = $nom . '.cin.' . pathinfo($_FILES['cin_file']['name'], PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['cin_file']['tmp_name'], $folder_path . '/' . $cin_file);
    }
    $bac_file = '';
    if (isset($_FILES['bac_file']) && $_FILES['bac_file']['error'] === UPLOAD_ERR_OK) {
      $bac_file = $nom . '.bac.' . pathinfo($_FILES['bac_file']['name'], PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['bac_file']['tmp_name'], $folder_path . '/' . $bac_file);
    }
    $releve = '';
    if (isset($_FILES['releve']) && $_FILES['releve']['error'] === UPLOAD_ERR_OK) {
      $releve = $nom . '.releve.' . pathinfo($_FILES['releve']['name'], PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['releve']['tmp_name'], $folder_path . '/' . $releve);
    }
    $diplome_file = '';
    if (isset($_FILES['diplome_file']) && $_FILES['diplome_file']['error'] === UPLOAD_ERR_OK) {
      $diplome_file = $nom . '.diplome.' . pathinfo($_FILES['diplome_file']['name'], PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['diplome_file']['tmp_name'], $folder_path . '/' . $diplome_file);
    }
    $sql = "UPDATE user_form SET `user-name`='$user_name' ,nom='$nom', prenom='$prenom',arb_nom='$arb_nom',
    arb_prenom='$arb_prenom',`password`='$password', email='$email',cin='$cin',
    sexe='$sexe',sitiationFamiliale='$sitiationFamiliale',dateNaissance='$dateNaissance',tel='$tel',adresse='$adresse',
    ville='$ville',diploma='$diploma',accessLevel='$accessLevel',accessLevelOption='$accessLevelOption',
    `optionn`='$option',type_diplome='$diplome',
    `image`='$image',cin_file='$cin_file', bac_file='$bac_file' ,releve='$releve', diplome_file='$diplome_file'        
    WHERE id=$id";
        if ($connexion->query($sql) === TRUE) {
          echo "Record updated successfully             <a href='users.php' class='btn btn-danger float-end'>back</a>          ";
          exit(); // Make sure to exit after redirection
        } else {
          echo "Error updating record: " . $connexion->error;
        }
      }

    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        
        $sql = "SELECT * FROM user_form WHERE id=$id";
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
            <a href='users.php' class='btn btn-danger float-end'>back</a>
            </h4>
            </div>
            <div class='card-body'>
            <form id='myForm' method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."' enctype='multipart/form-data'>
            <div class='tab' id='tab-1'>
            <h3>Identification</h3>
            <div class='col-6'>     
                <input type='hidden' name='id'  value='".$row["id"]."' >
                <label>User name:<span>*</span></label>
                <input type='text' name='user-name'id='userInput' value='".$row["user-name"]."'  name='user-name' class='form-control' placeholder='Enter your username'>
                <div id='userError' class='error-message'></div></div> <br>
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
                <label> :الاسم العائلي <span>*</span></label><br>
                <input type='text' id='name_arb' class='form-control' value='".$row["arb_nom"]."'name='arb_nom' placeholder='أدخل اسمك العائلي' ><div id='arbNomError' class='error-message'></div></div>
                <div class='col'>
                <label>:الاسم الشخصي<span>*</span></label><br>
                <input type='text' id='prenom_arb' name='arb_prenom' value='".$row["arb_prenom"]."'class='form-control' placeholder='أدخل اسمك الشخصي' ><div id='arbPrenomError' class='error-message'></div></div></div>
                <div class='row'>
                <div class='col'>
                <label>Mot de passe :<span>*</span></label><br>
                <input type='password' id='password' name='password' class='form-control'  ><div id='passwordError' class='error-message'></div></div>
                <div class='col'>
                <label >Confirmer le<span>*</span></label><br>
                <input type='password' id='password1' name='password1' class='form-control' ><div id='password1Error' class='error-message'></div></div></div>
                <div class='row'>
                <div class='col'>
                <label >Email :<span>*</span></label><br>
                <input type='text' id='email' name='email'value='".$row["email"]."' class='form-control' ><div id='emailError' class='error-message'></div></div>
                <div class='col'>
                <label >CIN:</label><br>
                <input type='text' class='form-control'value='".$row["cin"]."' id='cinInput' name='cin' >
                <div id='cinError' class='error-message'></div></div></div>
                <div class='row'>
                <div class='col'>
                <label for='sexe'>Sexe:</label>
                <select id='sexe' name='sexe' class='form-control' >
                    <option value='' selected disabled>Choisissez votre sexe</option>
                    <option value='m'" . ($row["sexe"] == 'm' ? 'selected' : '') . " >Masculin</option>
                    <option value='f'" . ($row["sexe"] == 'f' ? 'selected' : '') . " >Féminin</option>
                </select>
                <div id='sexeError' class='error-message'></div>
                </div><br>
                <div class='col'>
                <label for='situationFamiliale'>Situation familiale:</label>
                <select id='situationFamiliale' name='sitiationFamiliale' class='form-control'>
                    <option value='' selected disabled>Choisissez votre situation familiale</option>
                    <option value='celibataire' " . ($row["sitiationFamiliale"] == 'celibataire' ? 'selected' : '') . ">Célibataire</option>
                    <option value='marié'" . ($row["sitiationFamiliale"] == 'marié' ? 'selected' : '') . " >Marié(e)</option>
                    <option value='divorcé'" . ($row["sitiationFamiliale"] == 'divorcé' ? 'selected' : '') . " >Divorcé(e)</option>
                    <option value='veuf'" . ($row["sitiationFamiliale"] == 'veuf' ? 'selected' : '') . " >Veuf(e)</option>
                </select>
                <div id='situationFamilialeError' class='error-message'></div>
                <br></div></div>
                <div class='row'>
                <div class='col'>
                <label for='dateDeNaissance'>Date de naissance:<span>*</span></label>
                <input type='date' value='".$row["dateNaissance"]."' id='dateDeNaissance' name='dateDeNaissance' class='form-control'  >
                <div id='dateDeNaissanceError' class='error-message'></div></div><br>
                <div class='col'>
                <label for='tel'>Tél: <span>*</span></label>
                <input type='tel' id='tel' value='".$row["tel"]."' name='tel' class='form-control' placeholder='Entréz votre numero de telephone' >
                <div id='telError' class='error-message'></div></div></div><br>
                <label for='adresse'>Adresse:</label>
                <input id='adresse'value='".$row["adresse"]."' name='adresse' class='form-control'  >
                <div id='adresseError' class='error-message'></div><br>   
                <div class='row'>
                <div class='col'>       
                <label for='address-1-country' class='forminator-label'>Pays :</label><br>
                <select name='pays'class='form-control'id='address-1-country' class='forminator-select2 select2-hidden-accessible forminator-screen-reader-only' data-search='true' data-placeholder='Sélectionner un pays' data-default-value='' data-select2-id='select2-data-address-1-country' tabindex='-1' aria-hidden='true'><option value='' data-country-code=''  data-select2-id='select2-data-26-sb9t' disabled>Entrez votre pays</option><option value='Afghanistan' data-country-code='AF'>Afghanistan</option><option value='Albanie' data-country-code='AL'>Albanie</option><option value='Algérie' data-country-code='DZ'>Algérie</option><option value='Samoa américaines' data-country-code='AS'>Samoa américaines</option><option value='Andorre' data-country-code='AD'>Andorre</option><option value='Angola' data-country-code='AO'>Angola</option><option value='Anguilla' data-country-code='AI'>Anguilla</option><option value='Antarctique' data-country-code='AQ'>Antarctique</option><option value='Antigua-et-Barbuda' data-country-code='AG'>Antigua-et-Barbuda</option><option value='Argentine' data-country-code='AR'>Argentine</option><option value='Arménie' data-country-code='AM'>Arménie</option><option value='Australie' data-country-code='AU'>Australie</option><option value='Aruba' data-country-code='AW'>Aruba</option><option value='Autriche' data-country-code='AT'>Autriche</option><option value='Azerbaïdjan' data-country-code='AZ'>Azerbaïdjan</option><option value='Bahamas' data-country-code='BS'>Bahamas</option><option value='Bahreïn' data-country-code='BH'>Bahreïn</option><option value='Bangladesh' data-country-code='BD'>Bangladesh</option><option value='La Barbade' data-country-code='BB'>La Barbade</option><option value='Biélorussie' data-country-code='BY'>Biélorussie</option><option value='Belgique' data-country-code='BE'>Belgique</option><option value='Bélize' data-country-code='BZ'>Bélize</option><option value='Bénin' data-country-code='BJ'>Bénin</option><option value='Bermudes' data-country-code='BM'>Bermudes</option><option value='Bhoutan' data-country-code='BT'>Bhoutan</option><option value='Bolivie' data-country-code='BO'>Bolivie</option><option value='Bosnie-Herzégovine' data-country-code='BA'>Bosnie-Herzégovine</option><option value='Botswana' data-country-code='BW'>Botswana</option><option value='Île Bouvet' data-country-code='BV'>Île Bouvet</option><option value='Brésil' data-country-code='BR'>Brésil</option><option value='Territoire britannique de l’océan Indien' data-country-code='IO'>Territoire britannique de l’océan Indien</option><option value='Brunei' data-country-code='BN'>Brunei</option><option value='Bulgarie' data-country-code='BG'>Bulgarie</option><option value='Burkina Faso' data-country-code='BF'>Burkina Faso</option><option value='Burundi' data-country-code='BI'>Burundi</option><option value='Cambodge' data-country-code='KH'>Cambodge</option><option value='Cameroun' data-country-code='CM'>Cameroun</option><option value='Canada' data-country-code='CA'>Canada</option><option value='Cap Vert' data-country-code='CV'>Cap Vert</option><option value='Îles Caïmans' data-country-code='KY'>Îles Caïmans</option><option value='République Centrafricaine' data-country-code='CF'>République Centrafricaine</option><option value='Tchad' data-country-code='TD'>Tchad</option><option value='Chili' data-country-code='CL'>Chili</option><option value='Chine, République populaire de' data-country-code='CN'>Chine, République populaire de</option><option value='Île Christmas' data-country-code='CX'>Île Christmas</option><option value='Îles Cocos' data-country-code='CC'>Îles Cocos</option><option value='Colombie' data-country-code='CO'>Colombie</option><option value='Comores' data-country-code='KM'>Comores</option><option value='Congo, République démocratique du' data-country-code='CD'>Congo, République démocratique du</option><option value='Congo, République du' data-country-code='CG'>Congo, République du</option><option value='Îles Cook' data-country-code='CK'>Îles Cook</option><option value='Costa Rica' data-country-code='CR'>Costa Rica</option><option value='Côte d’Ivoire' data-country-code='CI'>Côte d’Ivoire</option><option value='Croatie' data-country-code='HR'>Croatie</option><option value='Cuba' data-country-code='CU'>Cuba</option><option value='Curaçao' data-country-code='CW'>Curaçao</option><option value='Chypre' data-country-code='CY'>Chypre</option><option value='République Tchèque' data-country-code='CZ'>République Tchèque</option><option value='Danemark' data-country-code='DK'>Danemark</option><option value='Djibouti' data-country-code='DJ'>Djibouti</option><option value='Dominique' data-country-code='DM'>Dominique</option><option value='République Dominicaine' data-country-code='DO'>République Dominicaine</option><option value='Timor-Oriental' data-country-code='TL'>Timor-Oriental</option><option value='Équateur' data-country-code='EC'>Équateur</option><option value='Égypte' data-country-code='EG'>Égypte</option><option value='République du Salvador' data-country-code='SV'>République du Salvador</option><option value='Guinée Équatoriale' data-country-code='GQ'>Guinée Équatoriale</option><option value='Érythrée' data-country-code='ER'>Érythrée</option><option value='Estonie' data-country-code='EE'>Estonie</option><option value='Éthiopie' data-country-code='ET'>Éthiopie</option><option value='Îles Falkland' data-country-code='FK'>Îles Falkland</option><option value='Îles Féroé' data-country-code='FO'>Îles Féroé</option><option value='Fidji' data-country-code='FJ'>Fidji</option><option value='Finlande' data-country-code='FI'>Finlande</option><option value='France' data-country-code='FR'>France</option><option value='France, Métropolitaine' data-country-code='FX'>France, Métropolitaine</option><option value='Guyane française' data-country-code='GF'>Guyane française</option><option value='Polynésie Française' data-country-code='PF'>Polynésie Française</option><option value='Terres australes et antarctiques françaises' data-country-code='TF'>Terres australes et antarctiques françaises</option><option value='Gabon' data-country-code='GA'>Gabon</option><option value='Gambie' data-country-code='GM'>Gambie</option><option value='Géorgie' data-country-code='GE'>Géorgie</option><option value='Allemagne' data-country-code='DE'>Allemagne</option><option value='Guernesey' data-country-code='GG'>Guernesey</option><option value='Ghana' data-country-code='GH'>Ghana</option><option value='Gibraltar' data-country-code='GI'>Gibraltar</option><option value='Grèce' data-country-code='GR'>Grèce</option><option value='Groenland' data-country-code='GL'>Groenland</option><option value='Grenade' data-country-code='GD'>Grenade</option><option value='Guadeloupe' data-country-code='GP'>Guadeloupe</option><option value='Guam' data-country-code='GU'>Guam</option><option value='Guatémala' data-country-code='GT'>Guatémala</option><option value='Guinée' data-country-code='GN'>Guinée</option><option value='Guinée-Bissau' data-country-code='GW'>Guinée-Bissau</option><option value='Guyane' data-country-code='GY'>Guyane</option><option value='Haïti' data-country-code='HT'>Haïti</option><option value='Île Heard et île Mcdonald' data-country-code='HM'>Île Heard et île Mcdonald</option><option value='Honduras' data-country-code='HN'>Honduras</option><option value='Hong Kong' data-country-code='HK'>Hong Kong</option><option value='Hongrie' data-country-code='HU'>Hongrie</option><option value='Islande' data-country-code='IS'>Islande</option><option value='Inde' data-country-code='IN'>Inde</option><option value='Indonésie' data-country-code='ID'>Indonésie</option><option value='Iran' data-country-code='IR'>Iran</option><option value='Iraq' data-country-code='IQ'>Iraq</option><option value='Ireland' data-country-code='IE'>Ireland</option><option value='Italie' data-country-code='IT'>Italie</option><option value='Jamaïque' data-country-code='JM'>Jamaïque</option><option value='Japon' data-country-code='JP'>Japon</option><option value='Jersey' data-country-code='JE'>Jersey</option><option value='Île Johnston' data-country-code='JT'>Île Johnston</option><option value='Jordanie' data-country-code='JO'>Jordanie</option><option value='Kazakhstan' data-country-code='KZ'>Kazakhstan</option><option value='Kenya' data-country-code='KE'>Kenya</option><option value='Kiribati' data-country-code='KI'>Kiribati</option><option value='Corée, République démocratique populaire de' data-country-code='KP'>Corée, République démocratique populaire de</option><option value='Corée, République de' data-country-code='KR'>Corée, République de</option><option value='Kosovo' data-country-code='XK'>Kosovo</option><option value='Koweït' data-country-code='KW'>Koweït</option><option value='Kirghizistan' data-country-code='KG'>Kirghizistan</option><option value='République démocratique populaire du Laos' data-country-code='LA'>République démocratique populaire du Laos</option><option value='Lettonie' data-country-code='LV'>Lettonie</option><option value='Liban' data-country-code='LB'>Liban</option><option value='Lesotho' data-country-code='LS'>Lesotho</option><option value='Libéria' data-country-code='LR'>Libéria</option><option value='Libye' data-country-code='LY'>Libye</option><option value='Liechtenstein' data-country-code='LI'>Liechtenstein</option><option value='Lithuanie' data-country-code='LT'>Lithuanie</option><option value='Luxembourg' data-country-code='LU'>Luxembourg</option><option value='Macao' data-country-code='MO'>Macao</option><option value='Macédoine du Nord' data-country-code='MK'>Macédoine du Nord</option><option value='Madagascar' data-country-code='MG'>Madagascar</option><option value='Malawi' data-country-code='MW'>Malawi</option><option value='Malaisie' data-country-code='MY'>Malaisie</option><option value='Maldives' data-country-code='MV'>Maldives</option><option value='Mali' data-country-code='ML'>Mali</option><option value='Malte' data-country-code='MT'>Malte</option><option value='Îles Marshall' data-country-code='MH'>Îles Marshall</option><option value='Martinique' data-country-code='MQ'>Martinique</option><option value='Mauritanie' data-country-code='MR'>Mauritanie</option><option value='Île Maurice' data-country-code='MU'>Île Maurice</option><option value='Mayotte' data-country-code='YT'>Mayotte</option><option value='Mexique' data-country-code='MX'>Mexique</option><option value='Micronésie' data-country-code='FM'>Micronésie</option><option value='Moldavie' data-country-code='MD'>Moldavie</option><option value='Monaco' data-country-code='MC'>Monaco</option><option value='Mongolie' data-country-code='MN'>Mongolie</option><option value='Montserrat' data-country-code='MS'>Montserrat</option><option value='Monténégro' data-country-code='ME'>Monténégro</option><option value='Maroc' data-country-code='MA' selected>Maroc</option><option value='Mozambique' data-country-code='MZ'>Mozambique</option><option value='Myanmar' data-country-code='MM'>Myanmar</option><option value='Namibie' data-country-code='NA'>Namibie</option><option value='Nauru' data-country-code='NR'>Nauru</option><option value='Népal' data-country-code='NP'>Népal</option><option value='Pays-Bas' data-country-code='NL'>Pays-Bas</option><option value='Antilles Néerlandaises' data-country-code='AN'>Antilles Néerlandaises</option><option value='Nouvelle-Calédonie' data-country-code='NC'>Nouvelle-Calédonie</option><option value='Nouvelle Zelande' data-country-code='NZ'>Nouvelle Zelande</option><option value='Nicaragua' data-country-code='NI'>Nicaragua</option><option value='Niger' data-country-code='NE'>Niger</option><option value='Nigeria' data-country-code='NG'>Nigeria</option><option value='Niué' data-country-code='NU'>Niué</option><option value='Île Norfolk' data-country-code='NF'>Île Norfolk</option><option value='Îles Mariannes du Nord' data-country-code='MP'>Îles Mariannes du Nord</option><option value='Norvège' data-country-code='NO'>Norvège</option><option value='Oman' data-country-code='OM'>Oman</option><option value='Pakistan' data-country-code='PK'>Pakistan</option><option value='Palau' data-country-code='PW'>Palau</option><option value='Palestine, État de' data-country-code='PS'>Palestine, État de</option><option value='Panama' data-country-code='PA'>Panama</option><option value='Papouasie-Nouvelle-Guinée' data-country-code='PG'>Papouasie-Nouvelle-Guinée</option><option value='Paraguay' data-country-code='PY'>Paraguay</option><option value='Pérou' data-country-code='PE'>Pérou</option><option value='Philippines' data-country-code='PH'>Philippines</option><option value='Îles Pitcairn' data-country-code='PN'>Îles Pitcairn</option><option value='Pologne' data-country-code='PL'>Pologne</option><option value='Portugal' data-country-code='PT'>Portugal</option><option value='Porto Rico' data-country-code='PR'>Porto Rico</option><option value='Qatar' data-country-code='QA'>Qatar</option><option value='Île de la Réunion' data-country-code='RE'>Île de la Réunion</option><option value='Roumanie' data-country-code='RO'>Roumanie</option><option value='Russie' data-country-code='RU'>Russie</option><option value='Rwanda' data-country-code='RW'>Rwanda</option><option value='Saint-Kitts-et-Nevis' data-country-code='KN'>Saint-Kitts-et-Nevis</option><option value='Sainte Lucie' data-country-code='LC'>Sainte Lucie</option><option value='Saint-Vincent-et-les-Grenadines' data-country-code='VC'>Saint-Vincent-et-les-Grenadines</option><option value='Samoa' data-country-code='WS'>Samoa</option><option value='Sainte-Hélène' data-country-code='SH'>Sainte-Hélène</option><option value='Saint Pierre et Miquelon' data-country-code='PM'>Saint Pierre et Miquelon</option><option value='Saint-Marin' data-country-code='SM'>Saint-Marin</option><option value='Sao Tomé-et-Principe' data-country-code='ST'>Sao Tomé-et-Principe</option><option value='Arabie Saoudite' data-country-code='SA'>Arabie Saoudite</option><option value='Sénégal' data-country-code='SN'>Sénégal</option><option value='Serbie' data-country-code='RS'>Serbie</option><option value='Seychelles' data-country-code='SC'>Seychelles</option><option value='Sierra Leone' data-country-code='SL'>Sierra Leone</option><option value='Singapour' data-country-code='SG'>Singapour</option><option value='Saint-Martin (Royaume des Pays-Bas)' data-country-code='MF'>Saint-Martin (Royaume des Pays-Bas)</option><option value='Slovaquie' data-country-code='SK'>Slovaquie</option><option value='Slovénie' data-country-code='SI'>Slovénie</option><option value='Îles Salomon' data-country-code='SB'>Îles Salomon</option><option value='Somalie' data-country-code='SO'>Somalie</option><option value='Afrique du Sud' data-country-code='ZA'>Afrique du Sud</option><option value='Géorgie du Sud et Sandwich du Sud' data-country-code='GS'>Géorgie du Sud et Sandwich du Sud</option><option value='Espagne' data-country-code='ES'>Espagne</option><option value='Sri Lanka' data-country-code='LK'>Sri Lanka</option><option value='Apatrides' data-country-code='XX'>Apatrides</option><option value='Soudan' data-country-code='SD'>Soudan</option><option value='Soudan, Sud' data-country-code='SS'>Soudan, Sud</option><option value='Suriname' data-country-code='SR'>Suriname</option><option value='Svalbard et Jan Mayen' data-country-code='SJ'>Svalbard et Jan Mayen</option><option value='Swaziland' data-country-code='SZ'>Swaziland</option><option value='Suède' data-country-code='SE'>Suède</option><option value='Suisse' data-country-code='CH'>Suisse</option><option value='Syrie' data-country-code='SY'>Syrie</option><option value='Taiwan, République de Chine' data-country-code='TW'>Taiwan, République de Chine</option><option value='Tadjikistan' data-country-code='TJ'>Tadjikistan</option><option value='Tanzanie' data-country-code='TZ'>Tanzanie</option><option value='Thaïlande' data-country-code='TH'>Thaïlande</option><option value='Togo' data-country-code='TG'>Togo</option><option value='Tokelau' data-country-code='TK'>Tokelau</option><option value='Tonga' data-country-code='TO'>Tonga</option><option value='Trinité et Tobago' data-country-code='TT'>Trinité et Tobago</option><option value='Tunisie' data-country-code='TN'>Tunisie</option><option value='Turquie' data-country-code='TR'>Turquie</option><option value='Turkménistan' data-country-code='TM'>Turkménistan</option><option value='Îles Turques-et-Caïques' data-country-code='TC'>Îles Turques-et-Caïques</option><option value='Tuvalu' data-country-code='TV'>Tuvalu</option><option value='Ouganda' data-country-code='UG'>Ouganda</option><option value='Ukraine' data-country-code='UA'>Ukraine</option><option value='Émirats Arabes Unis' data-country-code='AE'>Émirats Arabes Unis</option><option value='Royaume-Uni' data-country-code='GB'>Royaume-Uni</option><option value='Îles mineures éloignées des États-Unis' data-country-code='UM'>Îles mineures éloignées des États-Unis</option><option value='États-Unis d’Amérique (USA)' data-country-code='US'>États-Unis d’Amérique (USA)</option><option value='Uruguay' data-country-code='UY'>Uruguay</option><option value='Ouzbékistan' data-country-code='UZ'>Ouzbékistan</option><option value='Vanuatu' data-country-code='VU'>Vanuatu</option><option value='Cité du Vatican' data-country-code='VA'>Cité du Vatican</option><option value='Vénézuéla' data-country-code='VE'>Vénézuéla</option><option value='Vietnam' data-country-code='VN'>Vietnam</option><option value='Îles Vierges britanniques' data-country-code='VG'>Îles Vierges britanniques</option><option value='Îles Vierges américaines' data-country-code='VI'>Îles Vierges américaines</option><option value='Îles Wallis et Futuna' data-country-code='WF'>Îles Wallis et Futuna</option><option value='Sahara occidental' data-country-code='EH'>Sahara occidental</option><option value='Rép. Arabe du Yémen' data-country-code='YE'>Rép. Arabe du Yémen</option><option value='Yémen démocratique' data-country-code='YD'>Yémen démocratique</option><option value='Zambie' data-country-code='ZM'>Zambie</option><option value='Zimbabwe' data-country-code='ZW'>Zimbabwe</option></select>
                <div id='paysError' class='error-message'></div> </div><br>   
                <div class='col'>      
                <label for='ville'>Ville:<span>*</span></label>
                <input id='ville'value='".$row["ville"]."' name='ville' class='form-control'  >
                <div id='villeError' class='error-message'></div></div></div><br>
                <div class='tab' id = 'tab-2'>
                <h3>Formation</h3>
                <div class='col-6'>
                <label for='diploma'>l'année d'arrêt:</label>
                <select id='degree' name='diploma' class='form-control'>
                <option value='' disabled selected>choisi ...</option>
                <option value='BAC' >BAC</option>
                <option value='BAC+2'>BAC+2</option>
                <option value='BAC+3'>BAC+3</option>
                </select>
                <div id='diplomaError' class='error-message'></div></div><br><br>
                <div class='col-6'>
                <label for='select1'>Select your first option:</label>
                <select id='select1' name='accessLevel' class='form-control'>
                    <option value='' selected disabled> choisi ...</option>
                    <option value='LETTER'>LETTER</option>
                    <option value='SCIENTIFIC'>SCIENTIFIC</option>
                </select><div id='accessLevelError' class='error-message'></div></div><br><br>
                <div class='col-6'>
                <label for='select2'> Niveau d'accée:</label>
                <select id='select2'  name='accessLevelOption' class='form-control'>
                    <option value='' selected disabled>choisi ...</option>
                    <option value='BAC+3' >BAC+3</option>
                    <option value='BAC+5' >BAC+5</option>
                </select>
                <div id='accessLevelOptionError' class='error-message'></div></div><br><br>
                <label for=''> Option :</label><br>
                <div class='row'>
                <div class='col-2'>
                <label for='management'>MANAGEMENT:</label>
                <input type='radio' id='management' name='option' value='management' disabled></div>
                <div class='col-2'>
                <label for='informatique'>INFORMATIQUE:</label>
                <input type='radio' id='informatique' name='option' value='informatique' disabled></div>
                <div class='col-2'>
                <label for='telecommunication'>TELECOMMUNICATION:</label>
                <input type='radio' id='telecommunication' name='option' value='telecommunication' disabled>
                <div id='optionError' class='error-message'></div></div></div><br><br>
                <div class='row'>
                <div class='col'>
                <label for=''>Centre de passage</label>
                <div class='col-6'>
                <input type='text' id='diplome' name='type_diplome' placeholder='Votre diplome' class='form-control'  disabled>
                <div id='diplomeError' class='error-message'></div></div><br><br>
                <div id='additionalFields2'style='display:none;'>
                </div>
                <br><br>
                <h3>file </h3>
                <div class='tab' id = 'tab-3'>
                <div class='row'>
                <div class='col'>
                <label for=''>Image :<span>*</span></label>  
                <input type='file' id='fileInput' name='image' class='form-control'  ><div id='imageError' class='error-message'></div></div><br>
                <div class='col'>
                <label for=''>CIN :<span>*</span></label>  
                <input type='file' id='fileInput1' name='cin_file'  class='form-control' ><div id='cinfileError' class='error-message'></div></div></div><br>
                <div class='row'>
                <div class='col'>
                <label for=''>BACCALAUREAT :<span>*</span></label>
                <input type='file' id='fileInput2' name='bac_file'  class='form-control' ><div id='bacError' class='error-message'></div></div><br>
                <div class='col'>
                <label for=''>RELVE DE NOTES DE VOTRE BAC :<span>*</span></label>
                <input type='file' id='fileInput3' name='releve' class='form-control' ><div id='releveError' class='error-message'></div></div></div><br>  
                <div class='col-6'>    
                <label for=''>Diplome :</label>
                <input type='file' id='pdiblome' name='diplome_file' class='form-control'  disabled><div id='diplomefileError' class='error-message'></div></div><br>
                <button class='btn btn-success float-end'  type='submit' name='update'>Update</button>
                <div id='message'></div>
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
      arbNom: document.getElementById("name_arb"),
      arbPrenom: document.getElementById("prenom_arb"),
      userName: document.getElementById("userInput"),
      password: document.getElementById("password"),
      password1: document.getElementById("password1"),
      email: document.getElementById("email"),
      cin: document.getElementById("cinInput"),
      name: document.getElementById("nameInput"),
      prenom: document.getElementById("prenomInput"),
      sexe: document.getElementById("sexe"),
      situationFamiliale: document.getElementById("situationFamiliale"),
      dateDeNaissance: document.getElementById("dateDeNaissance"),
      adresse: document.getElementById("adresse"),
      ville: document.getElementById("ville"),
      pays: document.getElementById("address-1-country"),
      tel: document.getElementById("tel"),
      degree: document.getElementById("degree"),
      select1: document.getElementById("select1"),
      select2: document.getElementById("select2"),
      management: document.getElementById("management"),
      informatique: document.getElementById("informatique"),
      telecommunication: document.getElementById("telecommunication"),
      diplome: document.getElementById("diplome"),
      image: document.getElementById("fileInput"),
      cin_file: document.getElementById("fileInput1"),
      bac_file: document.getElementById("fileInput2"),
      releve: document.getElementById("fileInput3"),
      diplome_file: document.getElementById("pdiblome")
    };

    const errorElements = {
      arbNomError: document.getElementById("arbNomError"),
      arbPrenomError: document.getElementById("arbPrenomError"),
      userError: document.getElementById("userError"),
      passwordError: document.getElementById("passwordError"),
      password1Error: document.getElementById("password1Error"),
      emailError: document.getElementById("emailError"),
      cinError: document.getElementById("cinError"),
      nameError: document.getElementById("nameError"),
      prenomError: document.getElementById("prenomError"),
      sexeError: document.getElementById("sexeError"),
      situationFamilialeError: document.getElementById("situationFamilialeError"),
      dateDeNaissanceError: document.getElementById("dateDeNaissanceError"),
      adresseError: document.getElementById("adresseError"),
      villeError: document.getElementById("villeError"),
      paysError: document.getElementById("paysError"),
      telError: document.getElementById("telError"),
      diplomaError: document.getElementById("diplomaError"),
      accessLevelError: document.getElementById("accessLevelError"),
      accessLevelOptionError: document.getElementById("accessLevelOptionError"),
      optionError: document.getElementById("optionError"),
      diplomeError: document.getElementById("diplomeError"),
      imageError: document.getElementById("imageError"),
      cinfileError: document.getElementById("cinfileError"),
      bacError: document.getElementById("bacError"),
      releveError: document.getElementById("releveError"),
      diplomefileError: document.getElementById("diplomefileError")
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
    if (!/^[ء-ي\s]+$/.test(formElements.arbNom.value)) {
      errorElements.arbNomError.innerHTML = "الرجاء إدخال الأحرف باللغة العربية فقط";
      formElements.arbNom.classList.add("invalid-input");
      isValid = false;
    }
    if (!formElements.diplome.disabled && formElements.diplome.value.trim() === "") {
        errorElements.diplomeError.innerHTML = "Veuillez saisir votre diplôme";
        formElements.diplome.classList.add("invalid-input");
        isValid = false;
    }



    if (formElements.image.files.length === 0) {
      errorElements.imageError.innerHTML = "Veuillez sélectionner une image (JPEG, JPG, PNG)";
      isValid = false;
    } else {
      let validImageExtensions = ["image/jpeg", "image/jpg", "image/png"];
      let isValidImage = false;
      for (let i = 0; i < formElements.image.files.length; i++) {
        if (validImageExtensions.includes(formElements.image.files[i].type)) {
          isValidImage = true;
          break;
        }
      }
      if (!isValidImage) {
        errorElements.imageError.innerHTML = "Veuillez sélectionner une image au format JPEG, JPG ou PNG";
        isValid = false;
      }
    }

    if (formElements.cin_file.files.length === 0) {
      errorElements.cinfileError.innerHTML = "Veuillez sélectionner au moins un fichier pour la CIN (PDF)";
      isValid = false;
    } else {
      let validPDFExtensions = ["application/pdf"];
      let isValidPDF = true;
      for (let i = 0; i < formElements.cin_file.files.length; i++) {
        if (!validPDFExtensions.includes(formElements.cin_file.files[i].type)) {
          isValidPDF = false;
          break;
        }
      }
      if (!isValidPDF) {
        errorElements.cinfileError.innerHTML = "Veuillez sélectionner un fichier au format PDF pour la CIN";
        isValid = false;
      }
    }

    if (formElements.bac_file.files.length === 0) {
      errorElements.bacError.innerHTML = "Veuillez sélectionner au moins un fichier pour le BACCALAURÉAT (PDF)";
      isValid = false;
    } else {
      let validPDFExtensions = ["application/pdf"];
      let isValidPDF = true;
      for (let i = 0; i < formElements.bac_file.files.length; i++) {
        if (!validPDFExtensions.includes(formElements.bac_file.files[i].type)) {
          isValidPDF = false;
          break;
        }
      }
      if (!isValidPDF) {
        errorElements.bacError.innerHTML = "Veuillez sélectionner un fichier au format PDF pour le BACCALAURÉAT";
        isValid = false;
      }
    }

    if (formElements.releve.files.length === 0) {
      errorElements.releveError.innerHTML = "Veuillez sélectionner au moins un fichier pour le relevé de notes du BAC (PDF)";
      isValid = false;
    } else {
      let validPDFExtensions = ["application/pdf"];
      let isValidPDF = true;
      for (let i = 0; i < formElements.releve.files.length; i++) {
        if (!validPDFExtensions.includes(formElements.releve.files[i].type)) {
          isValidPDF = false;
          break;
        }
      }
      if (!isValidPDF) {
        errorElements.releveError.innerHTML = "Veuillez sélectionner un fichier au format PDF pour le relevé de notes du BAC";
        isValid = false;
      }
    }
    if (!formElements.diplome_file.disabled && formElements.diplome_file.files.length === 0) {
      errorElements.diplomefileError.innerHTML = "Veuillez sélectionner un fichier pour le diplôme (PDF)";
      isValid = false;
    } else if (formElements.diplome_file.files.length > 0) {
      let validPDFExtensions = ["application/pdf"];
      let isValidPDF = true;
      for (let i = 0; i < formElements.diplome_file.files.length; i++) {
        if (!validPDFExtensions.includes(formElements.diplome_file.files[i].type)) {
          isValidPDF = false;
          break;
        }
      }
      if (!isValidPDF) {
        errorElements.diplomefileError.innerHTML = "Veuillez sélectionner un fichier au format PDF pour le diplôme";
        isValid = false;
      }
    }
    const options = [formElements.management, formElements.informatique, formElements.telecommunication];
    const checkedOptions = options.filter(option => !option.disabled && option.checked);
    if (options.some(option => !option.disabled) && checkedOptions.length === 0) {
        errorElements.optionError.innerHTML = "Veuillez sélectionner une option";
        isValid = false;
    }
    if (formElements.degree.value === "") {
    errorElements.diplomaError.innerHTML = "Veuillez sélectionner l'année d'arrêt";
    formElements.degree.classList.add("invalid-input");
    isValid = false;
    }

    if (formElements.select1.value === "") {
        errorElements.accessLevelError.innerHTML = "Veuillez sélectionner votre première option";
        formElements.select1.classList.add("invalid-input");
        isValid = false;
    }

    if (formElements.select2.value === "") {
        errorElements.accessLevelOptionError.innerHTML = "Veuillez sélectionner le niveau d'accès";
        formElements.select2.classList.add("invalid-input");
        isValid = false;
    }

     // Validation du champ "Pays"
     if (formElements.pays.value === "") {
                errorElements.paysError.innerHTML = "Le champ Pays est obligatoire";
                formElements.pays.classList.add("invalid-input");
                isValid = false;
    }
    // Validation du champ "Tél"
    if (formElements.tel.value === "") {
        errorElements.telError.innerHTML = "Le champ Tél est obligatoire";
        formElements.tel.classList.add("invalid-input");
        isValid = false;
    } else if (!/^0[0-9]+$/.test(formElements.tel.value)) {
        errorElements.telError.innerHTML = "Le numéro de téléphone no valid ex:0685947593";
        formElements.tel.classList.add("invalid-input");
        isValid = false;
    }


    if (!/^[ء-ي\s]+$/.test(formElements.arbPrenom.value)) {
      errorElements.arbPrenomError.innerHTML = "الرجاء إدخال الأحرف باللغة العربية فقط";
      formElements.arbPrenom.classList.add("invalid-input");
      isValid = false;
    }
    if (formElements.sexe.value === "") {
      errorElements.sexeError.innerHTML = "Veuillez sélectionner le sexe";
      formElements.sexe.classList.add("invalid-input");
      isValid = false;
    }

    if (formElements.situationFamiliale.value === "") {
      errorElements.situationFamilialeError.innerHTML = "Veuillez sélectionner la situation familiale";
      formElements.situationFamiliale.classList.add("invalid-input");
      isValid = false;
    }

    if (formElements.userName.value === "" || formElements.userName.value.length < 8) {
      errorElements.userError.innerHTML = "Le nom d'utilisateur doit être composé d'au moins 8 caractères";
      formElements.userName.classList.add("invalid-input");
      isValid = false;
    }
    if (formElements.cin.value === "") {
      errorElements.cinError.innerHTML = "Veuillez saisir votre numéro de carte d'identité nationale";
      formElements.cin.classList.add("invalid-input");
      isValid = false;
    } else if (!isValidCIN(formElements.cin.value)) {
      errorElements.cinError.innerHTML = "Le numéro de la carte d'identité nationale est incorrect";
      formElements.cin.classList.add("invalid-input");
      isValid = false;
    }
    if (formElements.dateDeNaissance.value === "") {
      errorElements.dateDeNaissanceError.innerHTML = "Veuillez entrer la date de naissance";
      formElements.dateDeNaissance.classList.add("invalid-input");
      isValid = false;
    }

    if (formElements.adresse.value === "") {
      errorElements.adresseError.innerHTML = "Veuillez entrer l'adresse";
      formElements.adresse.classList.add("invalid-input");
      isValid = false;
    }

    if (formElements.ville.value === "") {
      errorElements.villeError.innerHTML = "Veuillez entrer la ville";
      formElements.ville.classList.add("invalid-input");
      isValid = false;
    }

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
  function isValidCIN(cin) {
    const cinRegex = /^[A-Z]{1,2}\d{6}$/;
    return cinRegex.test(cin);
  }
</script>

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
<?php include('includes/footer.php') ?>

