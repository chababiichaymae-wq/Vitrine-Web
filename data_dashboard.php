<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "site_web");
if ($conn->connect_error) {
    die(json_encode(["error" => "Connexion BD échouée"]));
}

// Exemple : récupérer le nombre d'utilisateurs inscrits par mois
$query = "SELECT MONTH(date_inscription) as mois, COUNT(*) as total 
          FROM utilisateurs 
          GROUP BY mois 
          ORDER BY mois";

$result = $conn->query($query);

$data = [
    "labels" => [],
    "data" => []
];

while ($row = $result->fetch_assoc()) {
    // Convertir le numéro du mois en nom (ex: 1 => Jan)
    $moisNum = (int) $row['mois'];
    $moisNom = date("M", mktime(0, 0, 0, $moisNum, 10)); // format court mois en anglais
    $data["labels"][] = $moisNom;
    $data["data"][] = (int) $row['total'];
}

echo json_encode($data);
