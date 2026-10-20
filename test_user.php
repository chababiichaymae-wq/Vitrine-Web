<?php
$conn = new mysqli("localhost", "root", "", "site_web");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$username = 'ton_nom_utilisateur_existant';  // change avec un username qui existe dans ta table

$stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
$utilisateur = $result->fetch_assoc();

if ($utilisateur) {
    echo "Utilisateur trouvé : " . $utilisateur['username'];
} else {
    echo "Utilisateur non trouvé.";
}
?>