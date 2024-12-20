
<?php
// Démarrer la session
session_start();
//si l'utilisateur a déjà visité la page auparavant
if (isset($_SESSION['visites'])) {
     //donc on incrémente le compteur de visites
     $_SESSION['visites']++;
    } else {
    $_SESSION['visites'] = 1;
}
    

// Vérifier si l'utilisateur s'est bienconnecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']=== true && $_SESSION['username']!== 'user') {
    header('Location: index.php'); // Dans le cas contraire, l'utilisateur sera redirigé vers la page de connexion
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>
<body>
    <h1>Bienvenue sur la page administrateur de l'atelier 3</h1>
    <p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
