<?php
require_once 'config.php';

// Fetch data from the database
$sql = "SELECT * FROM concours";
$result = $connexion->query($sql);

if ($result->num_rows > 0) {
    // Create a new Excel file
    $file = fopen("user_data.csv", "w");

    // Add column headers
    fputcsv($file, array('id','nom','prenom','cin','genre','pays','tel','dateDeNaissance','centre','date','email','degree','ville','diplome','accessLevel','accessLevelOption','optionn'));

    // Add data rows
    while ($row = $result->fetch_assoc()) {
        // Replace empty values with "--"
        foreach ($row as $key => $value) {
            if (empty($value)) {
                $row[$key] = "--";
            }
        }
        fputcsv($file, array($row['id'], $row['nom'],$row['prenom'],$row['cin'],$row['genre'],$row['pays'],$row['tel'],$row['dateDeNaissance'],$row['centre'],$row['date'],$row['email'],$row['degree'],$row['ville'],$row['diplome'],$row['accessLevel'],$row['accessLevelOption'],$row['optionn']));
    }

    // Close the file
    fclose($file);

    // Set headers to download the file
    header("Content-Type: application/csv");
    header("Content-Disposition: attachment;Filename=user_data.csv");

    // Download the file
    readfile("user_data.csv");
    // Delete the file
    unlink("user_data.csv");
} else {
    echo "0 results";
}
$connexion->close();
?>
