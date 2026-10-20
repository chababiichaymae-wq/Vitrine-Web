<?php
// Liste des emails par département
$emails = [
    "it" => "it@lamalifgroup.com",
    "facilities" => "facilities@lamalifgroup.com",
    "comptable" => "comptabilite@lamalifgroup.com",
    "chiffrage" => "chiffrage@lamalifgroup.com",
    "eclairage" => "eclairage@lamalifgroup.com",
    "marketing" => "marketing@lamalifgroup.com",
    "autre" => "contact@lamalifgroup.com"
];

// Vérification des champs
if (
    isset($_POST['nom'], $_POST['email'], $_POST['departement'], $_POST['sujet'], $_POST['message']) &&
    !empty($_POST['nom']) &&
    !empty($_POST['email']) &&
    !empty($_POST['departement']) &&
    !empty($_POST['sujet']) &&
    !empty($_POST['message']) &&
    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
    $nom = htmlspecialchars($_POST['nom']);
    $email_user = htmlspecialchars($_POST['email']);
    $departement = $_POST['departement'];
    $sujet = htmlspecialchars($_POST['sujet']);
    $message = htmlspecialchars($_POST['message']);

    if (!array_key_exists($departement, $emails)) {
        header("Location: contact.html?success=0");
        exit;
    }

    $destinataire = $emails[$departement];
    $contenu = "Nom : $nom\n";
    $contenu .= "E-mail : $email_user\n";
    $contenu .= "Département : $departement\n";
    $contenu .= "Sujet : $sujet\n";
    $contenu .= "Message :\n$message";
    $headers = "From: $email_user";

    // Envoi du mail
    if (mail($destinataire, $sujet, $contenu, $headers)) {
        header("Location: contact.html?success=1");
        exit;
    } else {
        header("Location: contact.html?success=0");
        exit;
    }
} else {
    // Accès direct au script ou formulaire vide => ne rien afficher
    header("Location: contact.html");
    exit;
}
