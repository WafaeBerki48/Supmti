



<?php 
$pageTitle="Concours";
include('includes/header.php');
require_once 'admin/config.php';?>
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
    h1{
      text-align:center;
    } 
    #convocation{
        display: none;
      }
</style>
<div class="card-body">
<div class="container">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
<h1>inscrire ou concour</h1>

<form action="insert_data.php" method="post" id="myForm">
    <div class="row">
    <div class="col-md-6">
    <label for="nameInput">Nom:</label>
    <input type="text" class="box" id="nameInput" name="nom"  required>
    </div>
    <div class="col-md-6">
    <label for="prenom">Prénom:</label>
    <input type="text" id="prenomInput" class="box" name="prenom"  required>
    </div>
    </div>
    <div class="row">
    <div class="col-md-6">
    <label for="cinInput">CIN:</label>
    <input type="text" class="box" id="cinInput" name="cin"> </div>
    <div class="col-md-6"> 
    <span class="sex">Genre :</span><br><br>
    <label class="control control--radio">Homme
    <input type="radio" name="genre" value='m' id="male" />
    <div class="control__indicator"></div>
    </label>
    <label class="control control--radio">Femme
    <input type="radio" name="genre" value='f' id="femelle" /></label>
    </div>
    </div>
    <div class="row">
    <div class="col-md-6">
    <span>Pays</span>
    <select class="box" name="pays" id="address-1-country"  data-search="true" data-placeholder="Sélectionner un pays" data-default-value="" data-select2-id="select2-data-address-1-country" tabindex="-1" aria-hidden="true"><option value="">-- Pays --</option><option value="" data-country-code="" selected="selected" data-select2-id="select2-data-26-sb9t"></option><option value="Afghanistan" data-country-code="AF">Afghanistan</option><option value="Albanie" data-country-code="AL">Albanie</option><option value="Algérie" data-country-code="DZ">Algérie</option><option value="Samoa américaines" data-country-code="AS">Samoa américaines</option><option value="Andorre" data-country-code="AD">Andorre</option><option value="Angola" data-country-code="AO">Angola</option><option value="Anguilla" data-country-code="AI">Anguilla</option><option value="Antarctique" data-country-code="AQ">Antarctique</option><option value="Antigua-et-Barbuda" data-country-code="AG">Antigua-et-Barbuda</option><option value="Argentine" data-country-code="AR">Argentine</option><option value="Arménie" data-country-code="AM">Arménie</option><option value="Australie" data-country-code="AU">Australie</option><option value="Aruba" data-country-code="AW">Aruba</option><option value="Autriche" data-country-code="AT">Autriche</option><option value="Azerbaïdjan" data-country-code="AZ">Azerbaïdjan</option><option value="Bahamas" data-country-code="BS">Bahamas</option><option value="Bahreïn" data-country-code="BH">Bahreïn</option><option value="Bangladesh" data-country-code="BD">Bangladesh</option><option value="La Barbade" data-country-code="BB">La Barbade</option><option value="Biélorussie" data-country-code="BY">Biélorussie</option><option value="Belgique" data-country-code="BE">Belgique</option><option value="Bélize" data-country-code="BZ">Bélize</option><option value="Bénin" data-country-code="BJ">Bénin</option><option value="Bermudes" data-country-code="BM">Bermudes</option><option value="Bhoutan" data-country-code="BT">Bhoutan</option><option value="Bolivie" data-country-code="BO">Bolivie</option><option value="Bosnie-Herzégovine" data-country-code="BA">Bosnie-Herzégovine</option><option value="Botswana" data-country-code="BW">Botswana</option><option value="Île Bouvet" data-country-code="BV">Île Bouvet</option><option value="Brésil" data-country-code="BR">Brésil</option><option value="Territoire britannique de l’océan Indien" data-country-code="IO">Territoire britannique de l’océan Indien</option><option value="Brunei" data-country-code="BN">Brunei</option><option value="Bulgarie" data-country-code="BG">Bulgarie</option><option value="Burkina Faso" data-country-code="BF">Burkina Faso</option><option value="Burundi" data-country-code="BI">Burundi</option><option value="Cambodge" data-country-code="KH">Cambodge</option><option value="Cameroun" data-country-code="CM">Cameroun</option><option value="Canada" data-country-code="CA">Canada</option><option value="Cap Vert" data-country-code="CV">Cap Vert</option><option value="Îles Caïmans" data-country-code="KY">Îles Caïmans</option><option value="République Centrafricaine" data-country-code="CF">République Centrafricaine</option><option value="Tchad" data-country-code="TD">Tchad</option><option value="Chili" data-country-code="CL">Chili</option><option value="Chine, République populaire de" data-country-code="CN">Chine, République populaire de</option><option value="Île Christmas" data-country-code="CX">Île Christmas</option><option value="Îles Cocos" data-country-code="CC">Îles Cocos</option><option value="Colombie" data-country-code="CO">Colombie</option><option value="Comores" data-country-code="KM">Comores</option><option value="Congo, République démocratique du" data-country-code="CD">Congo, République démocratique du</option><option value="Congo, République du" data-country-code="CG">Congo, République du</option><option value="Îles Cook" data-country-code="CK">Îles Cook</option><option value="Costa Rica" data-country-code="CR">Costa Rica</option><option value="Côte d’Ivoire" data-country-code="CI">Côte d’Ivoire</option><option value="Croatie" data-country-code="HR">Croatie</option><option value="Cuba" data-country-code="CU">Cuba</option><option value="Curaçao" data-country-code="CW">Curaçao</option><option value="Chypre" data-country-code="CY">Chypre</option><option value="République Tchèque" data-country-code="CZ">République Tchèque</option><option value="Danemark" data-country-code="DK">Danemark</option><option value="Djibouti" data-country-code="DJ">Djibouti</option><option value="Dominique" data-country-code="DM">Dominique</option><option value="République Dominicaine" data-country-code="DO">République Dominicaine</option><option value="Timor-Oriental" data-country-code="TL">Timor-Oriental</option><option value="Équateur" data-country-code="EC">Équateur</option><option value="Égypte" data-country-code="EG">Égypte</option><option value="République du Salvador" data-country-code="SV">République du Salvador</option><option value="Guinée Équatoriale" data-country-code="GQ">Guinée Équatoriale</option><option value="Érythrée" data-country-code="ER">Érythrée</option><option value="Estonie" data-country-code="EE">Estonie</option><option value="Éthiopie" data-country-code="ET">Éthiopie</option><option value="Îles Falkland" data-country-code="FK">Îles Falkland</option><option value="Îles Féroé" data-country-code="FO">Îles Féroé</option><option value="Fidji" data-country-code="FJ">Fidji</option><option value="Finlande" data-country-code="FI">Finlande</option><option value="France" data-country-code="FR">France</option><option value="France, Métropolitaine" data-country-code="FX">France, Métropolitaine</option><option value="Guyane française" data-country-code="GF">Guyane française</option><option value="Polynésie Française" data-country-code="PF">Polynésie Française</option><option value="Terres australes et antarctiques françaises" data-country-code="TF">Terres australes et antarctiques françaises</option><option value="Gabon" data-country-code="GA">Gabon</option><option value="Gambie" data-country-code="GM">Gambie</option><option value="Géorgie" data-country-code="GE">Géorgie</option><option value="Allemagne" data-country-code="DE">Allemagne</option><option value="Guernesey" data-country-code="GG">Guernesey</option><option value="Ghana" data-country-code="GH">Ghana</option><option value="Gibraltar" data-country-code="GI">Gibraltar</option><option value="Grèce" data-country-code="GR">Grèce</option><option value="Groenland" data-country-code="GL">Groenland</option><option value="Grenade" data-country-code="GD">Grenade</option><option value="Guadeloupe" data-country-code="GP">Guadeloupe</option><option value="Guam" data-country-code="GU">Guam</option><option value="Guatémala" data-country-code="GT">Guatémala</option><option value="Guinée" data-country-code="GN">Guinée</option><option value="Guinée-Bissau" data-country-code="GW">Guinée-Bissau</option><option value="Guyane" data-country-code="GY">Guyane</option><option value="Haïti" data-country-code="HT">Haïti</option><option value="Île Heard et île Mcdonald" data-country-code="HM">Île Heard et île Mcdonald</option><option value="Honduras" data-country-code="HN">Honduras</option><option value="Hong Kong" data-country-code="HK">Hong Kong</option><option value="Hongrie" data-country-code="HU">Hongrie</option><option value="Islande" data-country-code="IS">Islande</option><option value="Inde" data-country-code="IN">Inde</option><option value="Indonésie" data-country-code="ID">Indonésie</option><option value="Iran" data-country-code="IR">Iran</option><option value="Iraq" data-country-code="IQ">Iraq</option><option value="Ireland" data-country-code="IE">Ireland</option><option value="Italie" data-country-code="IT">Italie</option><option value="Jamaïque" data-country-code="JM">Jamaïque</option><option value="Japon" data-country-code="JP">Japon</option><option value="Jersey" data-country-code="JE">Jersey</option><option value="Île Johnston" data-country-code="JT">Île Johnston</option><option value="Jordanie" data-country-code="JO">Jordanie</option><option value="Kazakhstan" data-country-code="KZ">Kazakhstan</option><option value="Kenya" data-country-code="KE">Kenya</option><option value="Kiribati" data-country-code="KI">Kiribati</option><option value="Corée, République démocratique populaire de" data-country-code="KP">Corée, République démocratique populaire de</option><option value="Corée, République de" data-country-code="KR">Corée, République de</option><option value="Kosovo" data-country-code="XK">Kosovo</option><option value="Koweït" data-country-code="KW">Koweït</option><option value="Kirghizistan" data-country-code="KG">Kirghizistan</option><option value="République démocratique populaire du Laos" data-country-code="LA">République démocratique populaire du Laos</option><option value="Lettonie" data-country-code="LV">Lettonie</option><option value="Liban" data-country-code="LB">Liban</option><option value="Lesotho" data-country-code="LS">Lesotho</option><option value="Libéria" data-country-code="LR">Libéria</option><option value="Libye" data-country-code="LY">Libye</option><option value="Liechtenstein" data-country-code="LI">Liechtenstein</option><option value="Lithuanie" data-country-code="LT">Lithuanie</option><option value="Luxembourg" data-country-code="LU">Luxembourg</option><option value="Macao" data-country-code="MO">Macao</option><option value="Macédoine du Nord" data-country-code="MK">Macédoine du Nord</option><option value="Madagascar" data-country-code="MG">Madagascar</option><option value="Malawi" data-country-code="MW">Malawi</option><option value="Malaisie" data-country-code="MY">Malaisie</option><option value="Maldives" data-country-code="MV">Maldives</option><option value="Mali" data-country-code="ML">Mali</option><option value="Malte" data-country-code="MT">Malte</option><option value="Îles Marshall" data-country-code="MH">Îles Marshall</option><option value="Martinique" data-country-code="MQ">Martinique</option><option value="Mauritanie" data-country-code="MR">Mauritanie</option><option value="Île Maurice" data-country-code="MU">Île Maurice</option><option value="Mayotte" data-country-code="YT">Mayotte</option><option value="Mexique" data-country-code="MX">Mexique</option><option value="Micronésie" data-country-code="FM">Micronésie</option><option value="Moldavie" data-country-code="MD">Moldavie</option><option value="Monaco" data-country-code="MC">Monaco</option><option value="Mongolie" data-country-code="MN">Mongolie</option><option value="Montserrat" data-country-code="MS">Montserrat</option><option value="Monténégro" data-country-code="ME">Monténégro</option><option value="Maroc" data-country-code="MA" selected>Maroc</option><option value="Mozambique" data-country-code="MZ">Mozambique</option><option value="Myanmar" data-country-code="MM">Myanmar</option><option value="Namibie" data-country-code="NA">Namibie</option><option value="Nauru" data-country-code="NR">Nauru</option><option value="Népal" data-country-code="NP">Népal</option><option value="Pays-Bas" data-country-code="NL">Pays-Bas</option><option value="Antilles Néerlandaises" data-country-code="AN">Antilles Néerlandaises</option><option value="Nouvelle-Calédonie" data-country-code="NC">Nouvelle-Calédonie</option><option value="Nouvelle Zelande" data-country-code="NZ">Nouvelle Zelande</option><option value="Nicaragua" data-country-code="NI">Nicaragua</option><option value="Niger" data-country-code="NE">Niger</option><option value="Nigeria" data-country-code="NG">Nigeria</option><option value="Niué" data-country-code="NU">Niué</option><option value="Île Norfolk" data-country-code="NF">Île Norfolk</option><option value="Îles Mariannes du Nord" data-country-code="MP">Îles Mariannes du Nord</option><option value="Norvège" data-country-code="NO">Norvège</option><option value="Oman" data-country-code="OM">Oman</option><option value="Pakistan" data-country-code="PK">Pakistan</option><option value="Palau" data-country-code="PW">Palau</option><option value="Palestine, État de" data-country-code="PS">Palestine, État de</option><option value="Panama" data-country-code="PA">Panama</option><option value="Papouasie-Nouvelle-Guinée" data-country-code="PG">Papouasie-Nouvelle-Guinée</option><option value="Paraguay" data-country-code="PY">Paraguay</option><option value="Pérou" data-country-code="PE">Pérou</option><option value="Philippines" data-country-code="PH">Philippines</option><option value="Îles Pitcairn" data-country-code="PN">Îles Pitcairn</option><option value="Pologne" data-country-code="PL">Pologne</option><option value="Portugal" data-country-code="PT">Portugal</option><option value="Porto Rico" data-country-code="PR">Porto Rico</option><option value="Qatar" data-country-code="QA">Qatar</option><option value="Île de la Réunion" data-country-code="RE">Île de la Réunion</option><option value="Roumanie" data-country-code="RO">Roumanie</option><option value="Russie" data-country-code="RU">Russie</option><option value="Rwanda" data-country-code="RW">Rwanda</option><option value="Saint-Kitts-et-Nevis" data-country-code="KN">Saint-Kitts-et-Nevis</option><option value="Sainte Lucie" data-country-code="LC">Sainte Lucie</option><option value="Saint-Vincent-et-les-Grenadines" data-country-code="VC">Saint-Vincent-et-les-Grenadines</option><option value="Samoa" data-country-code="WS">Samoa</option><option value="Sainte-Hélène" data-country-code="SH">Sainte-Hélène</option><option value="Saint Pierre et Miquelon" data-country-code="PM">Saint Pierre et Miquelon</option><option value="Saint-Marin" data-country-code="SM">Saint-Marin</option><option value="Sao Tomé-et-Principe" data-country-code="ST">Sao Tomé-et-Principe</option><option value="Arabie Saoudite" data-country-code="SA">Arabie Saoudite</option><option value="Sénégal" data-country-code="SN">Sénégal</option><option value="Serbie" data-country-code="RS">Serbie</option><option value="Seychelles" data-country-code="SC">Seychelles</option><option value="Sierra Leone" data-country-code="SL">Sierra Leone</option><option value="Singapour" data-country-code="SG">Singapour</option><option value="Saint-Martin (Royaume des Pays-Bas)" data-country-code="MF">Saint-Martin (Royaume des Pays-Bas)</option><option value="Slovaquie" data-country-code="SK">Slovaquie</option><option value="Slovénie" data-country-code="SI">Slovénie</option><option value="Îles Salomon" data-country-code="SB">Îles Salomon</option><option value="Somalie" data-country-code="SO">Somalie</option><option value="Afrique du Sud" data-country-code="ZA">Afrique du Sud</option><option value="Géorgie du Sud et Sandwich du Sud" data-country-code="GS">Géorgie du Sud et Sandwich du Sud</option><option value="Espagne" data-country-code="ES">Espagne</option><option value="Sri Lanka" data-country-code="LK">Sri Lanka</option><option value="Apatrides" data-country-code="XX">Apatrides</option><option value="Soudan" data-country-code="SD">Soudan</option><option value="Soudan, Sud" data-country-code="SS">Soudan, Sud</option><option value="Suriname" data-country-code="SR">Suriname</option><option value="Svalbard et Jan Mayen" data-country-code="SJ">Svalbard et Jan Mayen</option><option value="Swaziland" data-country-code="SZ">Swaziland</option><option value="Suède" data-country-code="SE">Suède</option><option value="Suisse" data-country-code="CH">Suisse</option><option value="Syrie" data-country-code="SY">Syrie</option><option value="Taiwan, République de Chine" data-country-code="TW">Taiwan, République de Chine</option><option value="Tadjikistan" data-country-code="TJ">Tadjikistan</option><option value="Tanzanie" data-country-code="TZ">Tanzanie</option><option value="Thaïlande" data-country-code="TH">Thaïlande</option><option value="Togo" data-country-code="TG">Togo</option><option value="Tokelau" data-country-code="TK">Tokelau</option><option value="Tonga" data-country-code="TO">Tonga</option><option value="Trinité et Tobago" data-country-code="TT">Trinité et Tobago</option><option value="Tunisie" data-country-code="TN">Tunisie</option><option value="Turquie" data-country-code="TR">Turquie</option><option value="Turkménistan" data-country-code="TM">Turkménistan</option><option value="Îles Turques-et-Caïques" data-country-code="TC">Îles Turques-et-Caïques</option><option value="Tuvalu" data-country-code="TV">Tuvalu</option><option value="Ouganda" data-country-code="UG">Ouganda</option><option value="Ukraine" data-country-code="UA">Ukraine</option><option value="Émirats Arabes Unis" data-country-code="AE">Émirats Arabes Unis</option><option value="Royaume-Uni" data-country-code="GB">Royaume-Uni</option><option value="Îles mineures éloignées des États-Unis" data-country-code="UM">Îles mineures éloignées des États-Unis</option><option value="États-Unis d’Amérique (USA)" data-country-code="US">États-Unis d’Amérique (USA)</option><option value="Uruguay" data-country-code="UY">Uruguay</option><option value="Ouzbékistan" data-country-code="UZ">Ouzbékistan</option><option value="Vanuatu" data-country-code="VU">Vanuatu</option><option value="Cité du Vatican" data-country-code="VA">Cité du Vatican</option><option value="Vénézuéla" data-country-code="VE">Vénézuéla</option><option value="Vietnam" data-country-code="VN">Vietnam</option><option value="Îles Vierges britanniques" data-country-code="VG">Îles Vierges britanniques</option><option value="Îles Vierges américaines" data-country-code="VI">Îles Vierges américaines</option><option value="Îles Wallis et Futuna" data-country-code="WF">Îles Wallis et Futuna</option><option value="Sahara occidental" data-country-code="EH">Sahara occidental</option><option value="Rép. Arabe du Yémen" data-country-code="YE">Rép. Arabe du Yémen</option><option value="Yémen démocratique" data-country-code="YD">Yémen démocratique</option><option value="Zambie" data-country-code="ZM">Zambie</option><option value="Zimbabwe" data-country-code="ZW">Zimbabwe</option></select></div> 
    <div class="col-md-6">
    <label>Téléphone :</label><div class="minput">
    <input type="tel" id="tel" class="box"name="tel"required></div></div>
    <div class="row">
    <div class="col-md-6">
    <label>Date de naissance :</label>
    <input type="date" class="box" id="dateDeNaissance" name="dateDeNaissance" >
    </div>
    <div class="col-md-6">
    <label for="">Centre de passage</label>
    <select class="box" name="centre" id="CentreInput">
    <option value="" selected disabled>Centre de passage</option>
    <option value="Oujda">Oujda</option>
    <option value="Meknès">Meknès</option>
    <option value="Beni Mellal">Beni Mellal</option>
    <option value="Rabat">Rabat</option>
    <option value="Agadir">Agadir</option>
    <option value="Laayoune">Laayoune</option>
    <option value="Dakhla">Dakhla</option>
    <option value="Errachidia">Errachidia</option>
    </select></div></div>
    <div class="row">
    <div class="col-md-6">
    <label for="">Date da passage</label>
    <select class='box'name="date" id="dateInput">
    <option value="" selected disabled>Date de passage</option>
    <option value="28 Mai">28 Mai</option>
    <option value="18 Juin">18 Juin</option>
    <option value="23 Juillet">23 Juillet</option>
    <option value="03 Septembre">03 Septembre</option>
    </select><br><br>
    </div>
    <div class="col-md-6">
    <label>Adresse e-mail :</label>
    <input type="email"class="box" id="email" name="email"required>
    </div>
    </div>
    <div class="row">
    <div class="col-md-6">
    <span>niveau d'etude</span>
    <select  class="box" id="degree" name="degree">
    <option value="BAC">Niveaux d'étude :</option>
    <option value="BAC">BAC</option>
    <option value="BAC+2">BAC+2</option>
    <option value="BAC+3">BAC+3</option>
    </select>
    </div>
    <div class="col-md-6">
    <label>Ville de résidence :</label><input type="text" class="box" id="ville" name="ville" required>
    </div></div>
    <div class="row">
    <div class="col-md-6">
    <label>Spécialité de votre diplome :</label>
    <input class="box" type="text" id="diplome" name="diplome"required  disabled>
    </div>
    <div class="col-md-6">
     <div id="myForm2" class="box">
    <span class="sex">Option :</span><br><label class="control control--radio">LETTER
    <input type="radio" id="letter" name="accessLevel" value="LETTER"> <div class="control__indicator"></div>
    </label><label class="control control--radio">SIENTIFIQUE
    <input type="radio" id="scientific" name="accessLevel" value="SCIENTIFIC"> 
    </div>
    </div>
    </div>
    <div id="myForm2">
    <div class="row">
    <div class="col-md-6">
    <label for="">Niveau d'acces :</label>
    <select class="box" id="accessLevelOption" name="accessLevelOption">
    <option value="" selected>Niveau d'accès:</option> 
    <option value="BAC+5">BAC+5</option> <option value="BAC+3">BAC+3</option>
    </select> 
    </div>
    </div>
    </div>

    <div class="col-md-6">
    <div id="letterOptions" style="display: none;"> 
    <span class="sex">Option d'accès:</span>
    <br> 
    <label class="control control--radio">MANAGEMENT<input type="radio" id="letterManagement" name="option" value="management"><div class="control__indicator"></div></label><br>
    </div> <div id="scientificOptions" style="display: none;"> 
    <span class="sex">BRANCH :</span><br><label class="control control--radio">MANAGEMENT
    <input type="radio" id="scientificManagement" name="option" value="management"> <div class="control__indicator"></div>
    </label><br><label class="control control--radio">INFORMATIQUE
    <input type="radio" id="scientificInformatique" name="option" value="informatique"> <div class="control__indicator"></div>
    </label><br><label class="control control--radio">TELECOMMUNICATION
    <div id="scientificTelecommunication"style="display: none;"> 
    <input type="radio" id="scientificTelecommunication" name="optionn" value="telecommunication">
    <div class="control__indicator"></div> </label>
    </div>
    </div>
  </div>
  <button class='btn  btn-danger' name="submit" >Submit</button>
  </div>   

  </div>
  </div>   

  </div>
  </div>

  <div id="convocation">
  <img src="img/R.png" alt=""  style="text-align: center;">
  <!-- style="color: blue; font-size: 14px;" --> <br><br><br><br>
 <u> <h1>Convocation d'inscription</h1></u>
<h2>Dear  <b><span id="greeting2"></span> <span  id="greeting"></span></b></h2>
<p style="font-size: 20px;">Voici votre convocation pour le concours scolaire :
  Nous avons le plaisir de vous informer que vous avez été inscrit avec succès au concours scolaire.
  La compétition aura lieu dans <b><span id="date_pass"></span> <span id="Centre_pass"></span></b>. Veuillez arriver sur le site de la compétition avant 8h00.
  Le coup d’envoi de la compétition sera donné à 9h00 précises.
  Bonne chance!
  Le comité du concours de l’école :</p>
  <img src="img/10.png" alt=""  style="padding-top: 250px; padding-left: 400px;">
</div>   
 

</form>
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
<script>
  const form2 = document.getElementById("myForm2"); 
  const additionalOptions = document.getElementById("additionalOptions"); 
  const letterOptions = document.getElementById("letterOptions");
    const scientificOptions = document.getElementById("scientificOptions"); 
    const scientificTelecommunication = document.getElementById("scientificTelecommunication");
    form2.addEventListener("change", (event) => { if (event.target.name === "accessLevel")
      { additionalOptions.style.display = "block"; 
      } });
      form2.addEventListener("change", (event) => {
      if (event.target.name === "accessLevelOption") { 
      if (event.target.value === "BAC+3") { 
      if (document.getElementById("letter").checked) {
      letterOptions.style.display = "block"; 
      scientificOptions.style.display = "none";
      scientificTelecommunication.style.display = "none";
      } else if (
    document.getElementById("scientific").checked) 
    
    
    { letterOptions.style.display = "none";
      scientificOptions.style.display = "block"; 
      scientificTelecommunication.style.display = "none"; 
      } } else if (event.target.value === "BAC+5") 
      { if (document.getElementById("letter").checked)
      { letterOptions.style.display = "block";
      scientificOptions.style.display = "none"; 
      scientificTelecommunication.style.display = "none";
      } else if (
      document.getElementById("scientific").checked) 
      { letterOptions.style.display = "none"; scientificOptions.style.display = "block";
      scientificTelecommunication.style.display = "block"; 
      } } } });
      form2.addEventListener("change", (event) => {
      if (event.target.name === "accessLevel")
      { if (event.target.value === "LETTER") { 
      document.getElementById("accessLevelOption").value = "BAC+3";
      letterOptions.style.display = "block";
      scientificOptions.style.display = "none";
      scientificTelecommunication.style.display = "none";
      } else if (event.target.value === "SCIENTIFIC")
      { document.getElementById("accessLevelOption").value = "BAC+3";

      letterOptions.style.display = "none"; scientificOptions.style.display = "block";
        scientificTelecommunication.style.display = "none";
      } } }); 
  
    const degreeSelect = document.getElementById("degree");
    const nameInput = document.getElementById("diplome");

    degreeSelect.addEventListener("change", () => {
      if (degreeSelect.value === "BAC") {
          nameInput.setAttribute("disabled", true);
        
      } else {
          nameInput.removeAttribute("disabled");
      }
    });



      for (let i = 0; i == 1; i++) {
          const newForm = createForm();
          formContainer.appendChild(newForm);
      }
      const form = document.getElementById('myForm');
      const identityTypeRadios = form.querySelectorAll('input[name="identityType"]');
      const identityInputContainer = document.getElementById('identityInputContainer');
      const cinInput = document.getElementById('cinInput');

      identityTypeRadios.forEach((radio) => {
          radio.addEventListener('change', (event) => {
              if (event.target.value === 'CIN') {
                  const cinInputClone = cinInput.cloneNode(true);
                  const cartSejourInput = document.createElement('input');
                  cartSejourInput.type = 'text';
                  cartSejourInput.id = 'cinInput';
                  cartSejourInput.name = 'cin';
                  identityInputContainer.innerHTML = '';
                  identityInputContainer.appendChild(document.createTextNode('CIN:'));
                  identityInputContainer.appendChild(cinInputClone);
              } else if (event.target.value === 'CART_SEJOUR') {
                  const cartSejourInput = document.createElement('input');
                  cartSejourInput.type = 'text';
                  cartSejourInput.id = 'cartSejourInput';
                  cartSejourInput.name = 'cart_sejour';
                  identityInputContainer.innerHTML = '';
                  identityInputContainer.appendChild(document.createTextNode('CART_SEJOUR:'));
                  identityInputContainer.appendChild(cartSejourInput);
              }
          });
      });
      
</script>

