<?php
$pageTitle="registration";
    include('includes/header.php');
    require_once 'admin/config.php';
?>
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
    background: #ffffff;
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
    // Connexion à la base de données
    include 'admin/config.php';
    $message = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nomUtilisateur = $connexion->real_escape_string($_POST['user-name']);
        $motDePasse = $connexion->real_escape_string(md5($_POST['password']));
        $nom = $connexion->real_escape_string($_POST['nom']);
        $prenom = $connexion->real_escape_string($_POST['prenom']);
        $email = $connexion->real_escape_string($_POST['email']);
        $tel = $connexion->real_escape_string($_POST['tel']);
        $adresse = $connexion->real_escape_string($_POST['adresse']);
        $ville = $connexion->real_escape_string($_POST['ville']);
        $pays = $connexion->real_escape_string($_POST['pays']);

        // Check if required fields are empty
        if (empty($nomUtilisateur) || empty($motDePasse)) {
            $message[] = 'Username and password are required.';
        } else {
            // File Upload
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                $image_tmp_name = $_FILES["image"]["tmp_name"];
                $image_name = $_FILES["image"]["name"];
                $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_filename = $nom . '.image.' . $file_extension;
                $image_folder = "admin/uploads/";

                // Create user folder if not exists
                $user_folder = $image_folder . $nom . "." . $prenom;
                if (!is_dir($user_folder)) {
                    mkdir($user_folder);
                }

                // Move uploaded file to user folder
                move_uploaded_file($image_tmp_name, $user_folder . "/" . $image_filename);
            } else {
                echo "Error uploading file.";
            }
        
            $existing_user_query = mysqli_query($connexion, "SELECT * FROM user_form WHERE `email`='$email'");
            if (mysqli_num_rows($existing_user_query) > 0) {
                echo "<div class='p-3 mb-2 bg-danger text-white'>User already exists. Registration Failed</div>";
            } else {
                $sql = mysqli_query($connexion, "INSERT INTO user_form (`user-name`, password, nom, prenom, email, tel, adresse, ville, pays, `image`) 
                        VALUES ('$nomUtilisateur', '$motDePasse', '$nom', '$prenom', '$email', '$tel', '$adresse', '$ville', '$pays','$image_filename')");
                if ($sql) {
                    echo "<div class='p-3 mb-2 bg-success text-white'>Les données ont été insérées avec succès</div>";
                } else {
                    echo "Error: " . $sql . "<br>" . $connexion->error;
                }
            }
        }
    }
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <a href="login.php" class="btn btn-danger">Login Here</a>
<form id="myForm" action="" method="post" autocomplete = "off" enctype="multipart/form-data">
      <h1 align = center><span id="sup">SUP</span><span id="mti">MTI</span></h1>
      <div style="text-align:center;">
        <span class="step" id = "step-1">1</span>
        <span class="step" id = "step-2">2</span>
        <span class="step" id = "step-3">3</span>
        <span class="step" id = "step-4">4</span>
      </div>
      <div class="tab" id = "tab-1">
        <h3>Acount info</h3><br>
        <label for="Nom utilisateurInput">Nom utilisateur:<span>*</span></label>
            <input type="text" id="user_name" name="user-name" placeholder="Entrez le nom de l'utilisateur " required>
            <label for="password">Mot de passe : *</label>
            <input id="password" name="password" type="password" class="required">
            <label for="confirm">Confirm Password *</label>
            <input id="confirm" name="confirm" type="password" class="required"><p style="color:red;" id="pass"></p>
                    <div class="index-btn-wrapper">
          <div class="index-btn" onclick="run(1, 2);">Next</div>
        </div>
      </div>
      <div class="tab" id = "tab-2">
      <h3>Indormation Personnel</h3><br>
      <label for="nameInput">Nom:<span>*</span></label>
            <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required><br>
            <label for="prenom">Prénom:<span>*</span></label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prenom" required><br>
            <label for="email">Email *</label>
            <input id="email" name="email" type="email" class="required email" ><p style="color:red;" id="pass2"></p>
            <label for="tel">Tél: <span>*</span></label>
            <input type="tel" id="tel" name="tel" placeholder="Entréz votre numero de telephone" required><br>          


        <div class="index-btn-wrapper">
          <div class="index-btn" onclick="run(2, 1);">Previous</div>
          <div class="index-btn" onclick="run(2, 3);">Next</div>
        </div>
      </div>
      <div class="tab" id = "tab-3">
      <h3>coordonnées</h3><br>
      <label for="address">Address</label>
            <input id="address" name="adresse" type="text">
            <label for="prenom">Ville:<span>*</span> </label>
            <input type="text" id="prenom" name="ville" required><br>
            <label for="address-1-country" class="forminator-label">Pays </label>
            <select name="pays" id="address-1-country" class="forminator-select2 select2-hidden-accessible forminator-screen-reader-only" data-search="true" data-placeholder="Sélectionner un pays" data-default-value="" data-select2-id="select2-data-address-1-country" tabindex="-1" aria-hidden="true"><option value="" data-country-code="" selected="selected" data-select2-id="select2-data-26-sb9t"></option><option value="Afghanistan" data-country-code="AF">Afghanistan</option><option value="Albanie" data-country-code="AL">Albanie</option><option value="Algérie" data-country-code="DZ">Algérie</option><option value="Samoa américaines" data-country-code="AS">Samoa américaines</option><option value="Andorre" data-country-code="AD">Andorre</option><option value="Angola" data-country-code="AO">Angola</option><option value="Anguilla" data-country-code="AI">Anguilla</option><option value="Antarctique" data-country-code="AQ">Antarctique</option><option value="Antigua-et-Barbuda" data-country-code="AG">Antigua-et-Barbuda</option><option value="Argentine" data-country-code="AR">Argentine</option><option value="Arménie" data-country-code="AM">Arménie</option><option value="Australie" data-country-code="AU">Australie</option><option value="Aruba" data-country-code="AW">Aruba</option><option value="Autriche" data-country-code="AT">Autriche</option><option value="Azerbaïdjan" data-country-code="AZ">Azerbaïdjan</option><option value="Bahamas" data-country-code="BS">Bahamas</option><option value="Bahreïn" data-country-code="BH">Bahreïn</option><option value="Bangladesh" data-country-code="BD">Bangladesh</option><option value="La Barbade" data-country-code="BB">La Barbade</option><option value="Biélorussie" data-country-code="BY">Biélorussie</option><option value="Belgique" data-country-code="BE">Belgique</option><option value="Bélize" data-country-code="BZ">Bélize</option><option value="Bénin" data-country-code="BJ">Bénin</option><option value="Bermudes" data-country-code="BM">Bermudes</option><option value="Bhoutan" data-country-code="BT">Bhoutan</option><option value="Bolivie" data-country-code="BO">Bolivie</option><option value="Bosnie-Herzégovine" data-country-code="BA">Bosnie-Herzégovine</option><option value="Botswana" data-country-code="BW">Botswana</option><option value="Île Bouvet" data-country-code="BV">Île Bouvet</option><option value="Brésil" data-country-code="BR">Brésil</option><option value="Territoire britannique de l’océan Indien" data-country-code="IO">Territoire britannique de l’océan Indien</option><option value="Brunei" data-country-code="BN">Brunei</option><option value="Bulgarie" data-country-code="BG">Bulgarie</option><option value="Burkina Faso" data-country-code="BF">Burkina Faso</option><option value="Burundi" data-country-code="BI">Burundi</option><option value="Cambodge" data-country-code="KH">Cambodge</option><option value="Cameroun" data-country-code="CM">Cameroun</option><option value="Canada" data-country-code="CA">Canada</option><option value="Cap Vert" data-country-code="CV">Cap Vert</option><option value="Îles Caïmans" data-country-code="KY">Îles Caïmans</option><option value="République Centrafricaine" data-country-code="CF">République Centrafricaine</option><option value="Tchad" data-country-code="TD">Tchad</option><option value="Chili" data-country-code="CL">Chili</option><option value="Chine, République populaire de" data-country-code="CN">Chine, République populaire de</option><option value="Île Christmas" data-country-code="CX">Île Christmas</option><option value="Îles Cocos" data-country-code="CC">Îles Cocos</option><option value="Colombie" data-country-code="CO">Colombie</option><option value="Comores" data-country-code="KM">Comores</option><option value="Congo, République démocratique du" data-country-code="CD">Congo, République démocratique du</option><option value="Congo, République du" data-country-code="CG">Congo, République du</option><option value="Îles Cook" data-country-code="CK">Îles Cook</option><option value="Costa Rica" data-country-code="CR">Costa Rica</option><option value="Côte d’Ivoire" data-country-code="CI">Côte d’Ivoire</option><option value="Croatie" data-country-code="HR">Croatie</option><option value="Cuba" data-country-code="CU">Cuba</option><option value="Curaçao" data-country-code="CW">Curaçao</option><option value="Chypre" data-country-code="CY">Chypre</option><option value="République Tchèque" data-country-code="CZ">République Tchèque</option><option value="Danemark" data-country-code="DK">Danemark</option><option value="Djibouti" data-country-code="DJ">Djibouti</option><option value="Dominique" data-country-code="DM">Dominique</option><option value="République Dominicaine" data-country-code="DO">République Dominicaine</option><option value="Timor-Oriental" data-country-code="TL">Timor-Oriental</option><option value="Équateur" data-country-code="EC">Équateur</option><option value="Égypte" data-country-code="EG">Égypte</option><option value="République du Salvador" data-country-code="SV">République du Salvador</option><option value="Guinée Équatoriale" data-country-code="GQ">Guinée Équatoriale</option><option value="Érythrée" data-country-code="ER">Érythrée</option><option value="Estonie" data-country-code="EE">Estonie</option><option value="Éthiopie" data-country-code="ET">Éthiopie</option><option value="Îles Falkland" data-country-code="FK">Îles Falkland</option><option value="Îles Féroé" data-country-code="FO">Îles Féroé</option><option value="Fidji" data-country-code="FJ">Fidji</option><option value="Finlande" data-country-code="FI">Finlande</option><option value="France" data-country-code="FR">France</option><option value="France, Métropolitaine" data-country-code="FX">France, Métropolitaine</option><option value="Guyane française" data-country-code="GF">Guyane française</option><option value="Polynésie Française" data-country-code="PF">Polynésie Française</option><option value="Terres australes et antarctiques françaises" data-country-code="TF">Terres australes et antarctiques françaises</option><option value="Gabon" data-country-code="GA">Gabon</option><option value="Gambie" data-country-code="GM">Gambie</option><option value="Géorgie" data-country-code="GE">Géorgie</option><option value="Allemagne" data-country-code="DE">Allemagne</option><option value="Guernesey" data-country-code="GG">Guernesey</option><option value="Ghana" data-country-code="GH">Ghana</option><option value="Gibraltar" data-country-code="GI">Gibraltar</option><option value="Grèce" data-country-code="GR">Grèce</option><option value="Groenland" data-country-code="GL">Groenland</option><option value="Grenade" data-country-code="GD">Grenade</option><option value="Guadeloupe" data-country-code="GP">Guadeloupe</option><option value="Guam" data-country-code="GU">Guam</option><option value="Guatémala" data-country-code="GT">Guatémala</option><option value="Guinée" data-country-code="GN">Guinée</option><option value="Guinée-Bissau" data-country-code="GW">Guinée-Bissau</option><option value="Guyane" data-country-code="GY">Guyane</option><option value="Haïti" data-country-code="HT">Haïti</option><option value="Île Heard et île Mcdonald" data-country-code="HM">Île Heard et île Mcdonald</option><option value="Honduras" data-country-code="HN">Honduras</option><option value="Hong Kong" data-country-code="HK">Hong Kong</option><option value="Hongrie" data-country-code="HU">Hongrie</option><option value="Islande" data-country-code="IS">Islande</option><option value="Inde" data-country-code="IN">Inde</option><option value="Indonésie" data-country-code="ID">Indonésie</option><option value="Iran" data-country-code="IR">Iran</option><option value="Iraq" data-country-code="IQ">Iraq</option><option value="Ireland" data-country-code="IE">Ireland</option><option value="Italie" data-country-code="IT">Italie</option><option value="Jamaïque" data-country-code="JM">Jamaïque</option><option value="Japon" data-country-code="JP">Japon</option><option value="Jersey" data-country-code="JE">Jersey</option><option value="Île Johnston" data-country-code="JT">Île Johnston</option><option value="Jordanie" data-country-code="JO">Jordanie</option><option value="Kazakhstan" data-country-code="KZ">Kazakhstan</option><option value="Kenya" data-country-code="KE">Kenya</option><option value="Kiribati" data-country-code="KI">Kiribati</option><option value="Corée, République démocratique populaire de" data-country-code="KP">Corée, République démocratique populaire de</option><option value="Corée, République de" data-country-code="KR">Corée, République de</option><option value="Kosovo" data-country-code="XK">Kosovo</option><option value="Koweït" data-country-code="KW">Koweït</option><option value="Kirghizistan" data-country-code="KG">Kirghizistan</option><option value="République démocratique populaire du Laos" data-country-code="LA">République démocratique populaire du Laos</option><option value="Lettonie" data-country-code="LV">Lettonie</option><option value="Liban" data-country-code="LB">Liban</option><option value="Lesotho" data-country-code="LS">Lesotho</option><option value="Libéria" data-country-code="LR">Libéria</option><option value="Libye" data-country-code="LY">Libye</option><option value="Liechtenstein" data-country-code="LI">Liechtenstein</option><option value="Lithuanie" data-country-code="LT">Lithuanie</option><option value="Luxembourg" data-country-code="LU">Luxembourg</option><option value="Macao" data-country-code="MO">Macao</option><option value="Macédoine du Nord" data-country-code="MK">Macédoine du Nord</option><option value="Madagascar" data-country-code="MG">Madagascar</option><option value="Malawi" data-country-code="MW">Malawi</option><option value="Malaisie" data-country-code="MY">Malaisie</option><option value="Maldives" data-country-code="MV">Maldives</option><option value="Mali" data-country-code="ML">Mali</option><option value="Malte" data-country-code="MT">Malte</option><option value="Îles Marshall" data-country-code="MH">Îles Marshall</option><option value="Martinique" data-country-code="MQ">Martinique</option><option value="Mauritanie" data-country-code="MR">Mauritanie</option><option value="Île Maurice" data-country-code="MU">Île Maurice</option><option value="Mayotte" data-country-code="YT">Mayotte</option><option value="Mexique" data-country-code="MX">Mexique</option><option value="Micronésie" data-country-code="FM">Micronésie</option><option value="Moldavie" data-country-code="MD">Moldavie</option><option value="Monaco" data-country-code="MC">Monaco</option><option value="Mongolie" data-country-code="MN">Mongolie</option><option value="Montserrat" data-country-code="MS">Montserrat</option><option value="Monténégro" data-country-code="ME">Monténégro</option><option value="Maroc" data-country-code="MA" selected>Maroc</option><option value="Mozambique" data-country-code="MZ">Mozambique</option><option value="Myanmar" data-country-code="MM">Myanmar</option><option value="Namibie" data-country-code="NA">Namibie</option><option value="Nauru" data-country-code="NR">Nauru</option><option value="Népal" data-country-code="NP">Népal</option><option value="Pays-Bas" data-country-code="NL">Pays-Bas</option><option value="Antilles Néerlandaises" data-country-code="AN">Antilles Néerlandaises</option><option value="Nouvelle-Calédonie" data-country-code="NC">Nouvelle-Calédonie</option><option value="Nouvelle Zelande" data-country-code="NZ">Nouvelle Zelande</option><option value="Nicaragua" data-country-code="NI">Nicaragua</option><option value="Niger" data-country-code="NE">Niger</option><option value="Nigeria" data-country-code="NG">Nigeria</option><option value="Niué" data-country-code="NU">Niué</option><option value="Île Norfolk" data-country-code="NF">Île Norfolk</option><option value="Îles Mariannes du Nord" data-country-code="MP">Îles Mariannes du Nord</option><option value="Norvège" data-country-code="NO">Norvège</option><option value="Oman" data-country-code="OM">Oman</option><option value="Pakistan" data-country-code="PK">Pakistan</option><option value="Palau" data-country-code="PW">Palau</option><option value="Palestine, État de" data-country-code="PS">Palestine, État de</option><option value="Panama" data-country-code="PA">Panama</option><option value="Papouasie-Nouvelle-Guinée" data-country-code="PG">Papouasie-Nouvelle-Guinée</option><option value="Paraguay" data-country-code="PY">Paraguay</option><option value="Pérou" data-country-code="PE">Pérou</option><option value="Philippines" data-country-code="PH">Philippines</option><option value="Îles Pitcairn" data-country-code="PN">Îles Pitcairn</option><option value="Pologne" data-country-code="PL">Pologne</option><option value="Portugal" data-country-code="PT">Portugal</option><option value="Porto Rico" data-country-code="PR">Porto Rico</option><option value="Qatar" data-country-code="QA">Qatar</option><option value="Île de la Réunion" data-country-code="RE">Île de la Réunion</option><option value="Roumanie" data-country-code="RO">Roumanie</option><option value="Russie" data-country-code="RU">Russie</option><option value="Rwanda" data-country-code="RW">Rwanda</option><option value="Saint-Kitts-et-Nevis" data-country-code="KN">Saint-Kitts-et-Nevis</option><option value="Sainte Lucie" data-country-code="LC">Sainte Lucie</option><option value="Saint-Vincent-et-les-Grenadines" data-country-code="VC">Saint-Vincent-et-les-Grenadines</option><option value="Samoa" data-country-code="WS">Samoa</option><option value="Sainte-Hélène" data-country-code="SH">Sainte-Hélène</option><option value="Saint Pierre et Miquelon" data-country-code="PM">Saint Pierre et Miquelon</option><option value="Saint-Marin" data-country-code="SM">Saint-Marin</option><option value="Sao Tomé-et-Principe" data-country-code="ST">Sao Tomé-et-Principe</option><option value="Arabie Saoudite" data-country-code="SA">Arabie Saoudite</option><option value="Sénégal" data-country-code="SN">Sénégal</option><option value="Serbie" data-country-code="RS">Serbie</option><option value="Seychelles" data-country-code="SC">Seychelles</option><option value="Sierra Leone" data-country-code="SL">Sierra Leone</option><option value="Singapour" data-country-code="SG">Singapour</option><option value="Saint-Martin (Royaume des Pays-Bas)" data-country-code="MF">Saint-Martin (Royaume des Pays-Bas)</option><option value="Slovaquie" data-country-code="SK">Slovaquie</option><option value="Slovénie" data-country-code="SI">Slovénie</option><option value="Îles Salomon" data-country-code="SB">Îles Salomon</option><option value="Somalie" data-country-code="SO">Somalie</option><option value="Afrique du Sud" data-country-code="ZA">Afrique du Sud</option><option value="Géorgie du Sud et Sandwich du Sud" data-country-code="GS">Géorgie du Sud et Sandwich du Sud</option><option value="Espagne" data-country-code="ES">Espagne</option><option value="Sri Lanka" data-country-code="LK">Sri Lanka</option><option value="Apatrides" data-country-code="XX">Apatrides</option><option value="Soudan" data-country-code="SD">Soudan</option><option value="Soudan, Sud" data-country-code="SS">Soudan, Sud</option><option value="Suriname" data-country-code="SR">Suriname</option><option value="Svalbard et Jan Mayen" data-country-code="SJ">Svalbard et Jan Mayen</option><option value="Swaziland" data-country-code="SZ">Swaziland</option><option value="Suède" data-country-code="SE">Suède</option><option value="Suisse" data-country-code="CH">Suisse</option><option value="Syrie" data-country-code="SY">Syrie</option><option value="Taiwan, République de Chine" data-country-code="TW">Taiwan, République de Chine</option><option value="Tadjikistan" data-country-code="TJ">Tadjikistan</option><option value="Tanzanie" data-country-code="TZ">Tanzanie</option><option value="Thaïlande" data-country-code="TH">Thaïlande</option><option value="Togo" data-country-code="TG">Togo</option><option value="Tokelau" data-country-code="TK">Tokelau</option><option value="Tonga" data-country-code="TO">Tonga</option><option value="Trinité et Tobago" data-country-code="TT">Trinité et Tobago</option><option value="Tunisie" data-country-code="TN">Tunisie</option><option value="Turquie" data-country-code="TR">Turquie</option><option value="Turkménistan" data-country-code="TM">Turkménistan</option><option value="Îles Turques-et-Caïques" data-country-code="TC">Îles Turques-et-Caïques</option><option value="Tuvalu" data-country-code="TV">Tuvalu</option><option value="Ouganda" data-country-code="UG">Ouganda</option><option value="Ukraine" data-country-code="UA">Ukraine</option><option value="Émirats Arabes Unis" data-country-code="AE">Émirats Arabes Unis</option><option value="Royaume-Uni" data-country-code="GB">Royaume-Uni</option><option value="Îles mineures éloignées des États-Unis" data-country-code="UM">Îles mineures éloignées des États-Unis</option><option value="États-Unis d’Amérique (USA)" data-country-code="US">États-Unis d’Amérique (USA)</option><option value="Uruguay" data-country-code="UY">Uruguay</option><option value="Ouzbékistan" data-country-code="UZ">Ouzbékistan</option><option value="Vanuatu" data-country-code="VU">Vanuatu</option><option value="Cité du Vatican" data-country-code="VA">Cité du Vatican</option><option value="Vénézuéla" data-country-code="VE">Vénézuéla</option><option value="Vietnam" data-country-code="VN">Vietnam</option><option value="Îles Vierges britanniques" data-country-code="VG">Îles Vierges britanniques</option><option value="Îles Vierges américaines" data-country-code="VI">Îles Vierges américaines</option><option value="Îles Wallis et Futuna" data-country-code="WF">Îles Wallis et Futuna</option><option value="Sahara occidental" data-country-code="EH">Sahara occidental</option><option value="Rép. Arabe du Yémen" data-country-code="YE">Rép. Arabe du Yémen</option><option value="Yémen démocratique" data-country-code="YD">Yémen démocratique</option><option value="Zambie" data-country-code="ZM">Zambie</option><option value="Zimbabwe" data-country-code="ZW">Zimbabwe</option></select>          
        </section>
        <div class="index-btn-wrapper">
          <div class="index-btn" onclick="run(3, 2);">Previous</div>
          <div class="index-btn" onclick="run(3, 4);">Next</div>
        </div>
      </div>

      <div class="tab" id = "tab-4">
        <h3>finir</h3><br>
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" id="">
         <label for="acceptTerms">Je suis d’accord avec les conditions générales.</label>
         <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required">
        <div class="index-btn-wrapper">
          <div class="index-btn" onclick="run(4, 3);">Previous</div>
          <div class="index-btn" onclick="run(4, 5);">Next</div>
        </div>
      </div>
      <div class="tab" id = "tab-5">
        <div class="index-btn-wrapper">
          <div class="index-btn" onclick="run(5, 4);">Previous</div>
          <button class = "index-btn" type="submit" name="submit" style = "background: blue;" >Submit</button>
        </div>
      </div>
</form>
<script>
        function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
    }
    function validatePassword(password) {
    var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return re.test(String(password));
    }
      // Default tab
      $(".tab").css("display", "none");
      $("#tab-1").css("display", "block");

      function run(hideTab, showTab){
        if(hideTab < showTab){ // If not press previous button
          // Validation if press next button
          var currentTab = 0;
          x = $('#tab-'+hideTab);
          y = $(x).find("input")
          for (i = 0; i < y.length; i++){
            if (y[i].value == ""){
              $(y[i]).css("background", "#ffdddd");
              return false;
            }
            if ($(y[i]).attr('id') === 'confirm' && y[i].value !== $('#password').val()) {
        $(y[i]).css("background", "#ffdddd");$("#pass").html("Passwords do not match");
        return false;
      }

      if ($(y[i]).attr('id') === 'password' && !validatePassword(y[i].value)) {
        $(y[i]).css("background", "#ffdddd");
        $("#pass").html("L'expression régulière du mot de passe doit contenir au moins huit caractères, au moins un chiffre ainsi que des lettres minuscules et majuscules et des caractères spéciaux.");
        return false;
      }
      if ($(y[i]).attr('id') === 'email' && !validateEmail(y[i].value)) {
        $(y[i]).css("background", "#ffdddd");
        $("#pass2").html("Please enter a valid email address");
        return false;
      }

      $("#pass").html("");
      $("#pass2").html("");



          }
        }

        // Progress bar
        for (i = 1; i < showTab; i++){
          $("#step-"+i).css("opacity", "1");
        }

        // Switch tab
        $("#tab-"+hideTab).css("display", "none");
        $("#tab-"+showTab).css("display", "block");
        $("input").css("background", "#fff");
      }

</script>
<?php include('includes/footer.php'); ?>
