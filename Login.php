<?php
session_start();

$conn = new mysqli("localhost", "root", "", "site_web");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $utilisateur = $result->fetch_assoc();

    if ($utilisateur) {
        // Si mot de passe haché :
        if (password_verify($password, $utilisateur["mot_de_passe"])) {
            $_SESSION['username'] = $username;
            header("Location: acceuil.html");
            exit;
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Nom d'utilisateur incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <?php
    if (!empty($error)) {
        echo "<p style='color:red; text-align:center;'>$error</p>";
        echo "<p style='text-align:center;'><a href='login.html'>Revenir à la page de connexion</a></p>";
    }
    ?>
</body>

</html>