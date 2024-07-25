<?php
include 'includes/header.php';
include 'config.php';

$message = '';

// Function to get settings by ID
function getById($table, $id) {
    global $connexion;
    $query = "SELECT * FROM $table WHERE id = 0";
    $result = mysqli_query($connexion, $query);
    return mysqli_fetch_assoc($result);
}

if (isset($_POST['save'])) {
    $title = mysqli_real_escape_string($connexion, $_POST['title']);
    $slug = mysqli_real_escape_string($connexion, $_POST['slug']);
    $small_description = mysqli_real_escape_string($connexion, $_POST['small_description']);
    $meta_description = mysqli_real_escape_string($connexion, $_POST['meta_description']);
    $meta_keyword = mysqli_real_escape_string($connexion, $_POST['meta_keyword']);
    $email1 = mysqli_real_escape_string($connexion, $_POST['email1']);
    $email2 = mysqli_real_escape_string($connexion, $_POST['email2']);
    $tel = mysqli_real_escape_string($connexion, $_POST['tel']);
    $address = mysqli_real_escape_string($connexion, $_POST['address']);
    $settingId = mysqli_real_escape_string($connexion, $_POST['settingId']);

    if ($settingId == 'insert') {
        $query = "INSERT INTO settings(title, slug, small_description, meta_description, meta_keyword, email1, email2, tel, address)
            VALUES ('$title', '$slug', '$small_description', '$meta_description', '$meta_keyword', '$email1', '$email2', '$tel', '$address')";
        $result = mysqli_query($connexion, $query);
        
        if ($result) {
            $message = "Paramètres enregistrés avec succès";
        } else {
            $message = "Échec de l'enregistrement des paramètres";
        }
    } else {
        $query = "UPDATE settings SET title='$title', slug='$slug', small_description='$small_description', meta_description='$meta_description', meta_keyword='$meta_keyword', email1='$email1', email2='$email2', tel='$tel', address='$address' WHERE id=$settingId";
        $result = mysqli_query($connexion, $query);

        if ($result) {
            $message = "Paramètres mis à jour avec succès";
        } else {
            $message = "Échec de la mise à jour des paramètres";
        }
    }
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <?php
                if ($message != '') {
                    echo '<div class="message">' . $message . '</div>';
                }
                ?>
                <h4>Paramètres du site</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <?php
                    $setting=getById('settings',1);
                    ?>
                    <input type="hidden" name="settingId" value="<?php echo $setting['id'] ?? 'insert'; ?>" />
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Titre</label>
                            <input type="text" value="<?php echo $setting['title'] ?? ""; ?>" name="title" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>URL/Domaine</label>
                            <input type="text" value="<?php echo $setting['slug'] ?? ""; ?>" name="slug" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Petite description</label>
                            <input type="text" value="<?php echo $setting['small_description'] ?? ""; ?>" name="small_description" class="form-control">
                        </div>
                        <h4 class="my-3">Paramètres SEO</h4>
                        <div class="col-md-6 mb-3">
                            <label>Description Meta</label>
                            <textarea rows="3" name="meta_description" class="form-control"><?php echo $setting['meta_description'] ?? ""; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Mots-clés Meta</label>
                            <textarea rows="3" name="meta_keyword" class="form-control"><?php echo $setting['meta_keyword'] ?? ""; ?></textarea>
                        </div>
                        <h4 class="my-3">Informations de contact</h4>
                        <div class="col-md-6 mb-3">
                            <label>Email 1</label>
                            <input type="email" value="<?php echo $setting['email1'] ?? ""; ?>" name="email1" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email 2</label>
                            <input type="email" value="<?php echo $setting['email2'] ?? ""; ?>" name="email2" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Téléphone</label>
                            <input type="tel" value="<?php echo $setting['tel'] ?? ""; ?>" name="tel" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Adresse</label>
                            <textarea rows="3" name="address" class="form-control"><?php echo $setting['address'] ?? ""; ?></textarea>
                        </div>
                        <div class="text-end mb-3">
                            <button name="save" type="submit" class="btn btn-primary">Enregistrer les paramètres</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
