<?php
$conn = new mysqli("localhost", "root", "", "site_web");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
} else {
    echo "Connexion réussie à la base de données.";
}
?>