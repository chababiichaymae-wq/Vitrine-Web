<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'site_web';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}
?>
